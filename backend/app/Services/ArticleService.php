<?php

namespace App\Services;

use App\Repositories\ArticleRepository;

class ArticleService
{
    public function __construct(
        protected ArticleRepository $repository
    ){}

    public function register(array $data)
    {
        if($this->repository->findByUrl($data['url']))
        {
            return null;
        }

        return $this->repository->create($data);
    }
}