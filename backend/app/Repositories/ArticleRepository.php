<?php

namespace App\Repositories;

use App\Models\Article;

class ArticleRepository
{
    public function create(array $data): Article
    {
        return Article::create($data);
    }

    public function findByUrl(string $url): ?Article
    {
        return Article::where('url',$url)->first();
    }

    public function getLatest(int $limit=20)
    {
        return Article::latest()->limit($limit)->get();
    }

    public function countAll(): int
    {
        return Article::count();
    }

    public function countToday(): int
    {
        return Article::whereDate(
            'scraped_at',
            today()
        )->count();
    }
}