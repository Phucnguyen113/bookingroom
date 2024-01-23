<?php
namespace App\Http\Contracts\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface BlogRepositoryContract {
    /**
     * @return Collection
     */
    public function getBlogsHomePage() :Collection;
}
