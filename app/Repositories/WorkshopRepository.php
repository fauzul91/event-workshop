<?php

namespace App\Repositories;

use App\Models\Workshop;
use App\Repositories\Contracts\WorkshopRepositoryInterface;

class WorkshopRepository implements WorkshopRepositoryInterface
{
    public function getAllNewWorkshop()
    {
        return Workshop::latest()->get();
    }
    public function find($id)
    {
        return Workshop::find($id);
    }
    public function getPrice($workshopid)
    {
        $workshop = $this->find($workshopid);
        return $workshop ? $workshop->price : 0;
    }
}