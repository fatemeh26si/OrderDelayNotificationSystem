<?php

namespace App\Providers;

use App\Repository\AgentDelayReportRepositoryInterface;
use App\Repository\AgentRepositoryInterface;
use App\Repository\CourierRepositoryInterface;
use App\Repository\DelayReportRepositoryInterface;
use App\Repository\Eloquent\AgentDelayReportRepository;
use App\Repository\Eloquent\AgentRepository;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Eloquent\CourierRepository;
use App\Repository\Eloquent\DelayReportRepository;
use App\Repository\Eloquent\OrderRepository;
use App\Repository\Eloquent\TripRepository;
use App\Repository\Eloquent\VendorRepository;
use App\Repository\EloquentRepositoryInterface;
use App\Repository\OrderRepositoryInterface;
use App\Repository\TripRepositoryInterface;
use App\Repository\VendorRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {

    }


    public function boot()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(VendorRepositoryInterface::class, VendorRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(CourierRepositoryInterface::class, CourierRepository::class);
        $this->app->bind(TripRepositoryInterface::class, TripRepository::class);
        $this->app->bind(DelayReportRepositoryInterface::class, DelayReportRepository::class);
        $this->app->bind(AgentRepositoryInterface::class, AgentRepository::class);
        $this->app->bind(AgentDelayReportRepositoryInterface::class, AgentDelayReportRepository::class);
    }
}
