<?php

namespace App\Repository;


interface
CourierRepositoryInterface
{
    public function all();
    public function create(array $data);
    public function update(array $data, $id);
    public function destroy($id);
    public function find($id);
    public function getModel();

}






