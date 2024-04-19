<?php

namespace App\Repository;


interface

DelayReportRepositoryInterface
{
    public function all();
    public function create(array $data);
    public function update(array $data, $id);
    public function destroy($id);
    public function find($id);
    public function getModel();

    public function notAssignedDelayInQueue();
    public function lastRequestOfOrderInQueue($orderId);

}






