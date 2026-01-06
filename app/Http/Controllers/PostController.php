<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::published()
            ->with('category')
            ->latest('published_at')
            ->paginate(12);

        $settings = \App\Models\GeneralSetting::first();
        
        return view('posts.index', compact('posts', 'settings'));
    }

    public function show(string $slug): View
    {
        $post = Post::published()
            ->where('slug', $slug)
            ->firstOrFail();

        $post->incrementViews();

        $relatedPosts = Post::published()
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        $settings = \App\Models\GeneralSetting::first();

        return view('posts.show', compact('post', 'relatedPosts', 'settings'));
    }

    public function search(Request $request): View
    {
        $query = trim($request->input('q', ''));
        $settings = \App\Models\GeneralSetting::first();

        // Require minimum 3 characters for search
        if (strlen($query) < 3) {
            return view('posts.search', [
                'posts' => new \Illuminate\Pagination\LengthAwarePaginator([], 0, 12),
                'query' => $query,
                'settings' => $settings,
                'error' => strlen($query) > 0 ? 'Kata pencarian minimal 3 karakter.' : null
            ]);
        }

        // Escape special LIKE characters to prevent DoS attacks
        $sanitized = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $query);

        $posts = Post::published()
            ->where(function ($q) use ($sanitized) {
                $q->where('title', 'like', "%{$sanitized}%")
                    ->orWhere('content', 'like', "%{$sanitized}%");
            })
            ->with('category')
            ->latest('published_at')
            ->limit(100) // Limit total results for performance
            ->paginate(12);

        return view('posts.search', compact('posts', 'query', 'settings'));
    }
}
