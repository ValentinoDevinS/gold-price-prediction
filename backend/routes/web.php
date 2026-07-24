<?php
use Illuminate\Support\Facades\Route;

require __DIR__.'/web/articles.php';
require __DIR__.'/web/full_articles.php';

Route::get('/design-test', function () {
    return view('design-test');
});

Route::view('/ui', 'ui.index')
    ->name('ui.index');