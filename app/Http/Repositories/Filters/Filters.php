<?php
namespace App\Http\Repositories\Filters;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Support\Arrayable;

abstract class Filters
{
    protected array $whereAble = [];
    public array $enableScopes = [];

    public function __construct(protected Arrayable|null $request = null)
    {
        if ($request === null) {
            $this->request = request()->collect();
        }
    }

    public function applyFilter(Builder $builder)
    {
        foreach ($this->whereAble as $key => $where) {
            $where = ucfirst($where);
            if (method_exists($this, "where{$where}")) {
                $this->{"where{$where}"}($builder);
            }
        }
    }

    public function applySort(Builder $builder)
    {
        if (method_exists($this, 'sort')) {
            $this->sort($builder);
        }
    }
}