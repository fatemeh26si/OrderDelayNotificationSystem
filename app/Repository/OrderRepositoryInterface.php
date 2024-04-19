<?php

namespace App\Repository;


interface
OrderRepositoryInterface
{
    public function all();
    public function create(array $data);
    public function update(array $data, $id);
    public function destroy($id);
    public function find($id);
    public function getModel();
    public function orderWithDeliveryInfo($orderId);
    public function vendorDelayReports($limit=null, $skip=null);

}






