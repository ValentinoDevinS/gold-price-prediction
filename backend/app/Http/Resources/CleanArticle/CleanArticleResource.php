<?php

namespace App\Http\Resources\CleanArticle;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CleanArticleResource extends JsonResource
{
    public function toArray(
        Request $request
    ): array {

        return [

            'uuid' => $this->uuid,

            'full_article_uuid' => $this->fullArticle?->uuid,

            'clean_content' => $this->clean_content,

            'original_word_count' => $this->original_word_count,

            'clean_word_count' => $this->clean_word_count,

            'cleaner_version' => $this->cleaner_version,

            'cleaned_at' => $this->cleaned_at,

            'created_at' => $this->created_at,

            'updated_at' => $this->updated_at,

        ];
    }
}