<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'thumbnail',
        'location',
        'start_date',
        'end_date',
        'status',
        'is_featured',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_featured' => 'boolean',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', now());
    }

    /**
     * Get native events together with agenda posts from the news module.
     *
     * The news editor uses the `agenda` content type (and also supports an
     * Agenda category), while native events use the events table. Keeping the
     * two sources in one collection lets both appear on the public agenda.
     */
    public static function agendaItems(): Collection
    {
        $eventItems = self::published()
            ->orderBy('start_date')
            ->get()
            ->map(fn (self $event): object => (object) [
                'source' => 'event',
                'id' => $event->id,
                'title' => $event->title,
                'slug' => $event->slug,
                'description' => $event->description,
                'content' => $event->content,
                'thumbnail' => $event->thumbnail,
                'location' => $event->location,
                'start_date' => $event->start_date,
                'end_date' => $event->end_date,
                'is_featured' => $event->is_featured,
            ]);

        $agendaPosts = Post::query()
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where(function (Builder $query): void {
                $query->whereRaw('LOWER(type) = ?', ['agenda'])
                    ->orWhereHas('category', function (Builder $categoryQuery): void {
                        $categoryQuery
                            ->where('slug', 'agenda')
                            ->orWhereRaw('LOWER(name) = ?', ['agenda']);
                    });
            })
            ->orderBy('published_at', 'desc')
            ->get();

        $postItems = $agendaPosts->map(fn (Post $post): object => (object) [
            'source' => 'post',
            'id' => $post->id,
            'title' => $post->title,
            'slug' => $post->slug,
            'description' => $post->excerpt,
            'content' => $post->content,
            'thumbnail' => $post->thumbnail,
            'location' => null,
            'start_date' => $post->published_at,
            'end_date' => null,
            'is_featured' => $post->is_featured,
        ]);

        return $eventItems
            ->concat($postItems)
            ->sortBy('start_date')
            ->values();
    }
}
