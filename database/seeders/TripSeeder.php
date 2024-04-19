<?php

namespace Database\Seeders;

use App\Enums\TripStatusEnum;
use App\Repository\TripRepositoryInterface;
use App\Repository\VendorRepositoryInterface;
use Illuminate\Database\Seeder;

class TripSeeder extends Seeder
{
    private $tripRepository;
    public function __construct(TripRepositoryInterface $tripRepository)
    {
        $this->tripRepository = $tripRepository;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $order1_trips = [
            [
                'order_id' => 1,
                'courier_id' => 1,
                'status' => TripStatusEnum::ASSIGNED->value,
                'event_time' => now()->sub('50 minute'),
            ],
            [
                'order_id' => 1,
                'courier_id' => 1,
                'status' => TripStatusEnum::AT_VENDOR->value,
                'event_time' => now()->sub('30 minute'),
            ],
            [
                'order_id' => 1,
                'courier_id' => 1,
                'status' => TripStatusEnum::PICKED->value,
                'event_time' => now()->sub('25 minute'),
            ],
            [
                'order_id' => 1,
                'courier_id' => 1,
                'status' => TripStatusEnum::DELIVERED->value,
                'event_time' => now()->sub('10 minute'),
            ]
        ];
        foreach ($order1_trips as $tripInfo){
            $this->tripRepository->firstOrCreate(
                [
                    'order_id' => $tripInfo['order_id'],
                    'status' => $tripInfo['status'],
                ],
                $tripInfo
            );
        }

    }
}
