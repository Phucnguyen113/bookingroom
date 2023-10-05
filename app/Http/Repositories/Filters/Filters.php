<?php
namespace App\Http\Repositories\Filters;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class Filters
{
    protected $builder;

    public function __construct(protected array|null $request = null)
    {
        if ($request === null) {
            $this->request = request()->all();
        }
    }
    public function applyFilter(Builder $builder)
    {
        if (!$this->builder instanceof Builder) {
            $this->builder = $builder;
        }
        foreach ($this->whereAble as $key => $where) {
            $where = ucfirst($where);
            $this->{"where{$where}"}($this->builder);
        }
    }
}