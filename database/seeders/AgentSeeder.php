<?php

namespace Database\Seeders;

use App\Repository\AgentRepositoryInterface;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    private $agentRepository;
    public function __construct(AgentRepositoryInterface $agentRepository)
    {
        $this->agentRepository = $agentRepository;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agents = [
            [
                'agent_number'=> 100001,
                'name'=> 'رامین نصیری',
            ],
            [
                'agent_number'=> 100002,
                'name'=> 'رضا نظری',
            ],
            [
                'agent_number'=> 100003,
                'name'=> 'علی اکبری',
            ],
        ];
        foreach ($agents as $agent){
            $this->agentRepository->firstOrCreate(
                [
                    'agent_number' => $agent['agent_number']
                ],
                [
                    'agent_number' => $agent['agent_number'],
                    'name' => $agent['name']
                ]
            );
        }

    }
}
