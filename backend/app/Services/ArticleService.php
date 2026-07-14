<?php

namespace App\Services;

use App\Helpers\HashHelper;
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

            $data['url_hash'] = HashHelper::generate($data['url']);

            if ($this->repository->findByHash($data['url_hash'])) {
                return null;
            }

            return $this->repository->create($data);

        });
    }

    public function list(int $perPage = 15)
    {
        return $this->repository->paginate($perPage);
    }
}