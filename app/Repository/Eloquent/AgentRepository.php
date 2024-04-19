<?php

namespace App\Repository\Eloquent;

use App\Models\Agent;
use App\Repository\AgentRepositoryInterface;

class AgentRepository extends BaseRepository implements AgentRepositoryInterface
{
    public function __construct(Agent $model)
    {
        parent::__construct($model);
    }
    public function findByAgentNumber($agentNumber)
    {
        return $this->model->where('agent_number', $agentNumber)
            ->first();
    }

}
