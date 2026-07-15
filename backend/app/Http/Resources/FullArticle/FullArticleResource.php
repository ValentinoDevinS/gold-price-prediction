<?php

namespace App\Http\Resources\FullArticle;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FullArticleResource extends JsonResource
{
    public function toArray(
        Request $request
    ): array {

        return [

            'uuid' => $this->uuid,

            'article_uuid' => $this->article->uuid,

            'content' => $this->content,

            'html' => $this->html,

            'author' => $this->author,

            'image_url' => $this->image_url,

            'word_count' => $this->word_count,

            'download_status' => $this->download_status,

            'downloaded_at' => $this->downloaded_at,

            'created_at' => $this->created_at,

            'updated_at' => $this->updated_at,

        ];
    }
}