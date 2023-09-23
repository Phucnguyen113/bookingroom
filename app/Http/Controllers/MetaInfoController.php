<?php

namespace App\Http\Controllers;

use App\Enums\MediaCollection;
use App\Http\Requests\MetaSlidesRequest;
use App\Http\Services\MetaInfoService;
use App\Models\MetaTag;
use Illuminate\Http\Request;

class MetaInfoController extends Controller
{
    protected $metaInfoService;

    public function __construct(MetaInfoService $metaInfoService)
    {
        $this->metaInfoService = $metaInfoService;
    }

    public function index()
    {
        $data = $this->metaInfoService->all();
        return view('metaInfo.index', compact('data'));
    }

    public function store(Request $request)
    {
        $this->metaInfoService->store($request);

        return redirect()->route('metaInfo.index');
    }

    public function slides()
    {
        $infoSlides = $this->metaInfoService->findInfoSlides();
        $infoSlides->load('media');
        return view('metaInfo.slides', compact('infoSlides'));
    }

    public function storeSlides(MetaSlidesRequest $request)
    {
        $this->metaInfoService->storeSlides($request);
        return redirect()->route('metaInfo.slide');
    }
}
