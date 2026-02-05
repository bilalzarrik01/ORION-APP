<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Link;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class LinkController extends Controller
{
    public function index()
    {
        $filters = [
            'q' => request()->query('q'),
            'category' => request()->query('category'),
            'tag' => request()->query('tag'),
        ];

        $links = Link::query()
            ->whereHas('category', fn ($query) => $query->where('user_id', Auth::id()))
            ->with(['category', 'tags'])
            ->when($filters['q'], function ($query, $q) {
                $query->where('title', 'like', '%' . $q . '%');
            })
            ->when($filters['category'], function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->when($filters['tag'], function ($query, $tagId) {
                $query->whereHas('tags', fn ($tagQuery) => $tagQuery->whereKey($tagId));
            })
            ->latest()
            ->get();

        $categories = $this->userCategories();
        $tags = Tag::query()
            ->whereHas('links.category', fn ($query) => $query->where('user_id', Auth::id()))
            ->orderBy('name')
            ->get();

        return view('links.index', compact('links', 'categories', 'tags', 'filters'));
    }

    public function create()
    {
        $categories = $this->userCategories();

        return view('links.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateLink($request);

        $link = Link::create([
            'title' => $validated['title'],
            'url' => $validated['url'],
            'category_id' => $validated['category_id'],
        ]);

        $link->tags()->sync($this->resolveTagIds($validated['tags'] ?? ''));

        return redirect()
            ->route('links.index')
            ->with('status', 'Link created.');
    }

    public function edit(string $id)
    {
        $link = $this->findUserLink($id);
        $categories = $this->userCategories();
        $tags = $link->tags->pluck('name')->implode(', ');

        return view('links.edit', compact('link', 'categories', 'tags'));
    }

    public function update(Request $request, string $id)
    {
        $link = $this->findUserLink($id);
        $validated = $this->validateLink($request);

        $link->update([
            'title' => $validated['title'],
            'url' => $validated['url'],
            'category_id' => $validated['category_id'],
        ]);

        $link->tags()->sync($this->resolveTagIds($validated['tags'] ?? ''));

        return redirect()
            ->route('links.index')
            ->with('status', 'Link updated.');
    }

    public function destroy(string $id)
    {
        $link = $this->findUserLink($id);
        $link->delete();

        return redirect()
            ->route('links.index')
            ->with('status', 'Link deleted.');
    }

    private function userCategories()
    {
        return Category::query()
            ->where('user_id', Auth::id())
            ->orderBy('name')
            ->get();
    }

    private function findUserLink(string $id): Link
    {
        return Link::query()
            ->whereKey($id)
            ->whereHas('category', fn ($query) => $query->where('user_id', Auth::id()))
            ->with('tags')
            ->firstOrFail();
    }

    private function validateLink(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'url' => ['required', 'url', 'max:2048'],
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')->where('user_id', Auth::id()),
            ],
            'tags' => ['nullable', 'string', 'max:255'],
        ]);
    }

    private function resolveTagIds(string $rawTags): array
    {
        $names = collect(explode(',', $rawTags))
            ->map(fn ($tag) => trim(mb_strtolower($tag)))
            ->filter()
            ->unique()
            ->values();

        if ($names->isEmpty()) {
            return [];
        }

        return $names->map(function ($name) {
            return Tag::firstOrCreate(['name' => $name])->id;
        })->all();
    }
}
