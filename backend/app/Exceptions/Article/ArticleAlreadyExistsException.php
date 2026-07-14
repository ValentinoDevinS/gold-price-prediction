<?php

namespace App\Exceptions\Article;

use App\Exceptions\BaseBusinessException;

class ArticleAlreadyExistsException extends BaseBusinessException
{
    protected int $statusCode = 409;

    protected $message = 'Article already exists.';
}