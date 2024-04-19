<?php

namespace App\Repository\Eloquent;

use App\Models\Vendor;
use App\Repository\VendorRepositoryInterface;

class VendorRepository extends BaseRepository implements VendorRepositoryInterface
{
    public function __construct(Vendor $model)
    {
        parent::__construct($model);
    }

}
