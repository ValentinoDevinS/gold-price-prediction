<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [

            'uuid' => $this->uuid,

            'title' => $this->title,

            'url' => $this->url,

            'source' => $this->source,

            'published_at' => $this->published_at,

            'language' => $this->language,

            'country' => $this->country,

            'keyword' => $this->keyword,

            'scraper' => $this->scraper,

            'status' => $this->status,

            'scraped_at' => $this->scraped_at,

            'created_at' => $this->created_at,

            'updated_at' => $this->updated_at,

        ];
    }
}