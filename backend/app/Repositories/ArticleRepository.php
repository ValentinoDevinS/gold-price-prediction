<?php

namespace App\Repositories;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ArticleRepository extends BaseRepository
{
    public function __construct(
        Article $article
    ) {
        parent::__construct($article);
    }

    public function findByHash(string $hash): ?Article
    {
        return $this->findBy(
            'url_hash',
            $hash
        );
    }

    public function latestArticles(
        int $perPage = 20
    ): LengthAwarePaginator {

        return $this->query()

            ->latest('published_at')

            ->paginate($perPage);

    }

    public function countToday(): int
    {
        return $this->query()

            ->whereDate(
                'scraped_at',
                Carbon::today()
            )

            ->count();
    }

    public function searchArticles(
        ?string $keyword,
        array $filters = [],
        int $perPage = 20
    ): LengthAwarePaginator {

        $query = $this->filterQuery($filters);

        if (!empty($keyword)) {

            $query->where(function ($q) use ($keyword) {

                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('source', 'like', "%{$keyword}%")
                  ->orWhere('keyword', 'like', "%{$keyword}%");

            });

        }

        return $query

            ->latest('published_at')

            ->paginate($perPage);
    }
}