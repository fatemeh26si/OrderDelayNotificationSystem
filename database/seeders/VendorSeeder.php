<?php

namespace Database\Seeders;

use App\Repository\VendorRepositoryInterface;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    private $vendorRepository;
    public function __construct(VendorRepositoryInterface $vendorRepository)
    {
        $this->vendorRepository = $vendorRepository;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->vendorRepository->firstOrCreate(
            [
                'id' => 1
            ],
            [
                'id' => 1,
                'name' => "باگت"
            ]
        );
        $this->vendorRepository->firstOrCreate(
            [
                'id' => 2
            ],
            [
                'id' => 2,
                'name' => "فست فود جو گریل"
            ]
        );
        $this->vendorRepository->firstOrCreate(
            [
                'id' => 3
            ],
            [
                'id' => 3,
                'name' => "میخوش"
            ]
        );
    }
}
