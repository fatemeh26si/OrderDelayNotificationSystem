<?php

namespace App\Repository\Eloquent;

use App\Models\DelayReport;
use App\Repository\DelayReportRepositoryInterface;


class DelayReportRepository extends BaseRepository implements DelayReportRepositoryInterface
{
    public function __construct(DelayReport $model)
    {
        parent::__construct($model);
    }

    public function notAssignedDelayInQueue()
    {
        return $this->model
            ->leftJoin('agent_delay_reports', function ($q){
                $q->on('delay_reports.id', '=', 'agent_delay_reports.delay_report_id');
                $q->where('agent_delay_reports.deleted_at');
            })
            ->selectRaw(
                'delay_reports.*,
                agent_delay_reports.status'
            )
            ->where('delay_reports.estimate_delivery_time', null)   ///order in queue
            ->where('agent_delay_reports.status', null)  // status is not pending or checked
            ->orderBy('delay_reports.request_date', 'asc')
            ->first();
    }

    /*get last report of order with agent status*/
    public function lastRequestOfOrderInQueue($orderId)
    {
        return $this->model
            ->leftJoin('agent_delay_reports', function ($q){
                $q->on('delay_reports.id', '=', 'agent_delay_reports.delay_report_id');
                $q->where('agent_delay_reports.deleted_at');
            })
            ->selectRaw(
                'delay_reports.*,
                agent_delay_reports.status'
            )
            ->where('delay_reports.estimate_delivery_time', null)   ///order in queue
            ->where('delay_reports.order_id', $orderId)
            ->orderBy('delay_reports.request_date', 'desc')
            ->first();
    }
/*

SELECT
delay_reports.*
,
agent_delay_reports.`status`
FROM
delay_reports
LEFT JOIN `agent_delay_reports` on delay_reports.id = agent_delay_reports.delay_report_id and agent_delay_reports.deleted_at is null

WHERE delay_reports.estimate_delivery_time IS NULL
AND order_id = 3

ORDER BY delay_reports.request_date desc
limit 1*/

}
