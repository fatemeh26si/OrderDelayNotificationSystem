<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Repository\OrderRepositoryInterface;

class OrderSeeder extends Seeder
{
    private $orderRepository;
    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository= $orderRepository;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->orderRepository->firstOrCreate(
            [
                'id' => 1
            ],
            [
                'id' => 1,
                'order_number' => '100001',
                'vendor_id' => 1,
                'delivery_time' => 50,
                'order_date' => now()->sub('1 hour'),
            ]
        );
        $this->orderRepository->firstOrCreate(
            [
                'id' => 2
            ],
            [
                'id' => 2,
                'order_number' => '100002',
                'vendor_id' => 1,
                'delivery_time' => 50,
                'order_date' => now()->sub('30 minute'),
            ]
        );
        $this->orderRepository->firstOrCreate(
            [
                'id' => 3
            ],
            [
                'id' => 3,
                'order_number' => '100003',
                'vendor_id' => 1,
                'delivery_time' => 50,
                'order_date' => now(),
            ]
        );
        $this->orderRepository->firstOrCreate(
            [
                'id' => 4
            ],
            [
                'id' => 4,
                'order_number' => '100004',
                'vendor_id' => 2,
                'delivery_time' => 70,
                'order_date' => now(),
            ]
        );
        $this->orderRepository->firstOrCreate(
            [
                'id' => 5
            ],
            [
                'id' => 5,
                'order_number' => '100005',
                'vendor_id' => 3,
                'delivery_time' => 60,
                'order_date' => now(),
            ]
        );
    }
}
