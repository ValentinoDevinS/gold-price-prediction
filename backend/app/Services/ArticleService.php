<?php

namespace App\Services;

use App\Repositories\ArticleRepository;
use Illuminate\Support\Facades\DB;

class ArticleService
{
    public function __construct(
        private readonly ArticleRepository $repository
    ) {
    }

    public function register(array $data)
    {
        return DB::transaction(function () use ($data) {

            if ($this->repository->findByUrl($data['url'])) {
                return null;
            }

            return $this->repository->create($data);

        });
    }
}