<?php

namespace App\Repository\Eloquent;

use App\Enums\TripStatusEnum;
use App\Models\DelayReport;
use App\Models\Order;
use App\Repository\OrderRepositoryInterface;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    public function orderWithDeliveryInfo($orderId)
    {
        $DelayReport = DelayReport::selectRaw("order_id,
		DATE_ADD( request_date, INTERVAL estimate_delivery_time MINUTE ) as new_delivery_estimate_time,
		 ROW_NUMBER() OVER (PARTITION BY order_id ORDER BY request_date desc ) AS rn")
            ->where('order_id', $orderId);

        return $this->model->where('id', $orderId)
            ->leftJoinSub($DelayReport, 'order_delay_reports', function ($q) {
                $q->on('orders.id', '=', 'order_delay_reports.order_id');
                $q->where('order_delay_reports.rn', 1);
            })
            ->selectRaw('*,
             DATE_ADD(order_date, INTERVAL delivery_time MINUTE) as delivery_estimate,
             CASE WHEN DATE_ADD( order_date, INTERVAL delivery_time MINUTE ) < "' . now() . '" THEN TRUE
             ELSE FALSE
             END AS was_delayed,
             new_delivery_estimate_time
             ')
            ->first();
    }

    public function vendorDelayReports($limit=null, $skip=null)
    {
        $records = $this->model->selectRaw("
        vendors.id,
	    vendors.name,

        sum(TIMESTAMPDIFF(SECOND, DATE_ADD( order_date, INTERVAL delivery_time MINUTE ),
	    (case WHEN
	    DATE_ADD( order_date, INTERVAL delivery_time MINUTE ) < NOW() and trips.event_time is NULL
	    then NOW()
	    ELSE
	    	trips.event_time
	    END)
	    )) as delay_in_second,

	    SEC_TO_TIME(sum(TIMESTAMPDIFF(SECOND, DATE_ADD( order_date, INTERVAL delivery_time MINUTE ),
	    (case WHEN
	    DATE_ADD( order_date, INTERVAL delivery_time MINUTE ) < NOW() and trips.event_time is NULL
	    then NOW()
	    ELSE
	    	trips.event_time
	    END)
	    ))) as delayed_time,
	    count(orders.id) as orders_count
        ");
        $records = $records->leftJoin('trips', function ($q){
            $q->on('trips.order_id', '=', 'orders.id');
            $q->where('trips.status', TripStatusEnum::DELIVERED->value);
            $q->where('trips.deleted_at', null);
        })
            ->leftJoin('vendors', function ($q){
                $q->on('orders.vendor_id', '=', 'vendors.id');
                $q->where('vendors.deleted_at', null);
            })
            ->whereDate('orders.order_date', '>=', now()->sub('7 day'))
            ->groupBy('orders.vendor_id')
            ->havingRaw('delay_in_second is not null')
            ->orderBy('delay_in_second', 'desc');

        $totalCount = $records->get()->count();
        if ($limit) {
            $pageCount = ceil($totalCount / $limit);
            $records = $records->take($limit);
            if ($skip) {
                $records = $records->skip($skip);
            }
        } else {
            $pageCount = 1;
        }
        $records = $records->get();
        return [
            "records" => $records,
            "total_count" => $totalCount,
            "page_count" => $pageCount,
        ];

    }

}
