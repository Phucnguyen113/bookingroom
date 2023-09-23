<?php
namespace App\Http\Services;

use App\Enums\MediaCollection;
use App\Http\Repositories\MetaInfoRepository;
use App\Http\Services\Traits\ForwardCallToEloquentRepository;

class MetaInfoService
{
    use ForwardCallToEloquentRepository;

    protected $metaInfoRepository;

    public function __construct(MetaInfoRepository $metaInfoRepository)
    {
        $this->metaInfoRepository = $metaInfoRepository;
    }

    public function store($request)
    {
        $this->metaInfoRepository->query()->truncate();
        $data = $this->convertStoreData($request);
        $this->metaInfoRepository->insert($data);
        if ($request->hasFile('logo')) {
            $data = ['type' => 'logo', 'value' => 'logo'];
            $info = $this->metaInfoRepository->create($data);
            
            $info->addMedia($request->file('logo'))->toMediaCollection(MediaCollection::MetaLogo);
        }
    }

    protected function convertStoreData($request)
    {
        $data = $request->except(['logo', '_token']);
        return collect($data)->map(function ($item, $index) {
            return [
                'type' => $index,
                'value' => $item,
            ];
        })->values()->toArray();;
    }
}