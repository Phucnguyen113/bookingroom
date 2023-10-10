<?php
namespace App\Http\Contracts\Repositories;

interface RoomRepositoryContract
{
    public function roomsWithHighestView();
}