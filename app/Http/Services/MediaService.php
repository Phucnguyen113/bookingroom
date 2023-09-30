<?php
namespace App\Http\Services;

use App\Http\Repositories\MediaRepository;

class MediaService
{
    protected $mediaRepository;

    public function __construct(MediaRepository $mediaRepository)
    {
        $this->mediaRepository = $mediaRepository;
    }

    public function delete($mediaId)
    {
        $this->mediaRepository->find($mediaId)->delete();
    }
}