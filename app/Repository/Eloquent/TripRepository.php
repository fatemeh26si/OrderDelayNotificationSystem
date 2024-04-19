<?php

namespace App\Repository\Eloquent;

use App\Enums\TripStatusEnum;
use App\Models\Trip;

;

use App\Repository\TripRepositoryInterface;

class TripRepository extends BaseRepository implements TripRepositoryInterface
{
    public function __construct(Trip $model)
    {
        parent::__construct($model);
    }

    public function tripInfo($orderId)
    {
        $statusQuery = '';
        foreach (TripStatusEnum::cases() as $tripStatus) {
            $statusQuery .= "(SELECT event_time from trips where order_id =" . $orderId . " and `status`='" . $tripStatus->value . "') as " . $tripStatus->value . ", ";
        }
        return $this->model->selectRaw("
            $statusQuery
            order_id,
            courier_id
        ")
            ->where('order_id', $orderId)
            ->groupBy('order_id')
            ->first();
    }

}
