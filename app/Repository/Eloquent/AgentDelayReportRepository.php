<?php

namespace App\Repository\Eloquent;

use App\Enums\DelayReportStatusEnum;
use App\Models\AgentDelayReport;
use App\Repository\AgentDelayReportRepositoryInterface;

class AgentDelayReportRepository extends BaseRepository implements AgentDelayReportRepositoryInterface
{
    public function __construct(AgentDelayReport $model)
    {
        parent::__construct($model);
    }
    public function pendingReportOfAgent($agentId)
    {
        return $this->model->where('agent_id', $agentId)
            ->where('status', DelayReportStatusEnum::PENDING->value)
            ->first();
    }

}
