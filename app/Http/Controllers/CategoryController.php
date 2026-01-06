<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function show(string $slug): View
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $posts = Post::published()
            ->where('category_id', $category->id)
            ->latest('published_at')
            ->paginate(12);

        $settings = \App\Models\GeneralSetting::first();

        return view('categories.show', compact('category', 'posts', 'settings'));
    }
}
