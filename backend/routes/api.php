<?php

Route::prefix('v1')

    ->group(function () {

        require __DIR__.'/api/articles.php';

    });