<?php
namespace App\Http\Contracts\Repositories;

interface CategoryRepositoryContract
{
    public function getCategoriesByType(string $type, array|string $select = '*');
}