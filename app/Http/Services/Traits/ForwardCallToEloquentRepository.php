<?php
namespace App\Http\Services\Traits;

use App\Http\Repositories\EloquentRepository;
use ReflectionClass;
use Illuminate\Support\Str;

trait ForwardCallToEloquentRepository {

    protected $passthru = ['all', 'find', 'create', 'update', 'updateOrInsert', 'findOrFail', 'firstOrCreate'];

    public function __call($method, $args)
    {
        if (in_array($method, $this->passthru)) {
            $reflect = new ReflectionClass(self::class);

            $nameClassService =Str::of($reflect->getName())->afterLast('\\');
            if ($nameClassService->endsWith('Service')) {
                $prefixRepo = $nameClassService->replace('Service', '')->lcfirst();

                if ($reflect->hasProperty($repo = $prefixRepo . 'Repository') && $this->{$repo} instanceof EloquentRepository) {
                    return $this->{$repo}->{$method}(...$args);
                }

                throw new \Exception("Don't exists repository [{$prefixRepo}Repository] in service", 400);

            }
        }
        throw new \Exception("Call to undefined method [$method] on " . self::class, 500);
    }
}