<?php

namespace App\Http\Services;

use App\Enums\MediaCollection;
use App\Http\Contracts\Repositories\BlogRepositoryContract;
use App\Http\Contracts\Services\BlogServiceContract;
use App\Http\Requests\BlogRequest;
use App\Http\Services\Traits\ForwardCallToEloquentRepository;
use App\Models\Blog;
use DOMDocument;
use DOMNodeList;

class BlogService implements BlogServiceContract {

    use ForwardCallToEloquentRepository;

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
        $blog->addMedia($request->thumbnail)->toMediaCollection(MediaCollection::BlogThumbnail);

        $blog->categories()->attach($request->category);
    }

    public function update(BlogRequest $request, string $id)
    {
        $blog = $this->blogRepository->where('id', $id)->firstOrFail();
        $blog->update($request->only('title', 'content'));
        if ($request->hasFile('thumbnail')) {
            $blog->addMedia($request->file('thumbnail'))->toMediaCollection(MediaCollection::BlogThumbnail);
        }
        $blog->categories()->sync($request->category);
    }

    protected function replaceImageInContent($request, $blog)
    {
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

        return $content;
    }

    public function getListBlogs()
    {
        return $this->blogRepository->all();
    }

    public function delete(string $id)
    {
        return $this->blogRepository->where('id', $id)->delete();
    }
}
