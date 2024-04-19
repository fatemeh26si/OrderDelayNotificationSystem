<?php

namespace Database\Seeders;

use App\Repository\CourierRepositoryInterface;
use Illuminate\Database\Seeder;

class CourierSeeder extends Seeder
{
    private $courierRepository;
    public function __construct(CourierRepositoryInterface $courierRepository)
    {
        $this->courierRepository = $courierRepository;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->courierRepository->firstOrCreate(
            [
                'id' => 1
            ],
            [
                'id' => 1,
                'name' => "علیرضا صمدی"
            ]
        );
    }
}
