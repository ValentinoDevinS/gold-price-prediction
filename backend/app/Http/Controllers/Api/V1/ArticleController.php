<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends BaseApiController
{
    public function __construct(
        private readonly ArticleService $service
    ) {}

    public function index(Request $request)
    {
        $articles = $this->service->search(

            $request->keyword,

            [

                'status'=>$request->status,

                'source'=>$request->source,

                'country'=>$request->country,

            ],

            $request->integer(
                'per_page',
                20
            )

        );

        return $this->success(

            ArticleResource::collection(
                $articles
            )

        );
    }

    public function store(
        StoreArticleRequest $request
    ) {

        $article = $this->service
            ->create(
                $request->validated()
            );

        if (!$article) {

            return $this->error(

                'Article already exists.',

                409

            );

        }

        return $this->created(

            new ArticleResource(
                $article
            )

        );

    }
}