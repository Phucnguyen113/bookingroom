<?php

namespace App\Http\Controllers;

use App\Http\Services\MediaService;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    protected $mediaService;

    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    public function delete($mediaId)
    {
        $this->mediaService->delete($mediaId);

        return response()->json([]);
    }
}
