<?php

namespace App\Repository\Eloquent;

use App\Models\Courier;
use App\Repository\CourierRepositoryInterface;

class CourierRepository extends BaseRepository implements CourierRepositoryInterface
{
    public function __construct(Courier $model)
    {
        parent::__construct($model);
    }

}
