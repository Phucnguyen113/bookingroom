<?php

namespace App\Http\Services;

use App\Http\Contracts\Repositories\BlogRepositoryContract;
use App\Http\Contracts\Services\BlogServiceContract;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use DOMDocument;
use DOMNodeList;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class BlogService implements BlogServiceContract {

    protected $blogRepository;

    public function __construct(BlogRepositoryContract $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }


    protected function storeImagesFromSummerNote(DOMNodeList $imageFile, Blog $blog)
    {
        foreach($imageFile as $item => $image) {
            $data = $image->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $imgeData = base64_decode($data);
            $image_name= time().$item.'.jpg';
            $path = storage_path() . $image_name;
            file_put_contents($path, $imgeData);

            $blog->addMedia($path)->toMediaCollection('blogs');
        }
    }

    public function store(BlogRequest $request)
    {
        $blog = $this->blogRepository->create($request->only(['title', 'content']));
        $dom = new DOMDocument();
        $dom->loadHtml($request->content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');
        $this->storeImagesFromSummerNote($imageFile, $blog);

        $medias = $blog->getMedia('blogs');
        foreach($imageFile as $item => $image) {
            $image->removeAttribute('src');
            $image->setAttribute('src', $medias[$item]->getUrl());
        }
         $content = $dom->saveHTML();
         $blog->update([
              'content' => $content,
         ]);

        return redirect()->route('blogs.index');
    }

    public function update(Request $request, string $id)
    {

    }
}
