<?php

namespace App\Http\Services;

use App\Enums\MediaCollection;
use App\Enums\Tags;
use App\Enums\TypeCategory;
use App\Http\Contracts\Repositories\BlogRepositoryContract;
use App\Http\Contracts\Repositories\CategoryRepositoryContract;
use App\Http\Contracts\Services\BlogServiceContract;
use App\Http\Requests\BlogRequest;
use App\Http\Services\Traits\ForwardCallToEloquentRepository;
use App\Models\Blog;
use DOMDocument;
use DOMNodeList;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Tags\Tag;
use Illuminate\Support\Str;

class BlogService implements BlogServiceContract {

    use ForwardCallToEloquentRepository;

    protected $blogRepository;
    protected $categoryRepository;

    public function __construct(BlogRepositoryContract $blogRepository, CategoryRepositoryContract $categoryRepository)
    {
        $this->blogRepository = $blogRepository;
        $this->categoryRepository = $categoryRepository;
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
        $blog = $this->blogRepository->create($request->only(['title', 'description','content']));
        $blog->translate()->create([
            'title' => $request->en_title,
            'description' => $request->en_description,
            'content' => $request->en_content,
        ]);
        $blog->addMedia($request->thumbnail)->toMediaCollection(MediaCollection::BlogThumbnail);
        $blog->attachTags($request->tags, Tags::Blog);
        $blog->categories()->attach($request->category);
    }

    public function update(BlogRequest $request, string $id)
    {
        $blog = $this->blogRepository->where('id', $id)->firstOrFail();
        $blog->update($request->only('title', 'description', 'content'));
        $this->updateOrCreateTranslate($blog, $request);
        if ($request->hasFile('thumbnail')) {
            $blog->addMedia($request->file('thumbnail'))->toMediaCollection(MediaCollection::BlogThumbnail);
        }
        $blog->categories()->sync($request->category);
        $blog->syncTagsWithType($request->tags, Tags::Blog);
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
        return $this->blogRepository->paginate(config('paginate.default'));
    }

    public function delete(string $id)
    {
        $blog = $this->blogRepository->where('id', $id)->first();
        if ($blog) {
            $blog->categories()->detach();
            $blog->translate()->delete();
            $blog->delete();
        }
    }

    public function getDependencyDataToCreateOrUpdate()
    {
        $categories = $this->categoryRepository->getCategoriesByType(TypeCategory::Blog, ['id', 'name']);
        $tags = Tag::where('type', Tags::Blog)->get()->map(function ($item) {
            $item->name = Str::title($item->name);
            return $item;
        });

        return compact('categories', 'tags');
    }

    public function getBlogsHomePage(): Collection
    {
        return $this->blogRepository->getBlogsHomePage();
    }

    public function updateOrCreateTranslate(Blog $blog, BlogRequest $request): void
    {
        $translate = $blog->translate;
        if ($translate) {
            $translate->update([
                'title' => $request->en_title,
                'description' => $request->en_description,
                'content' => $request->en_content,
            ]);
        } else {
            $blog->translate()->create([
                'title' => $request->en_title,
                'description' => $request->en_description,
                'content' => $request->en_content,
            ]);
        }
    }
}
