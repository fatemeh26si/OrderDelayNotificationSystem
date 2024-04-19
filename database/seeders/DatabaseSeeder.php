<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(VendorSeeder::class);
        $this->call(CourierSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(TripSeeder::class);
        $this->call(AgentSeeder::class);
    }
}
