<?php


use Illuminate\Support\Facades\Route;
use Modules\Api\Controllers\ScrapeApiController;


Route::post('/web-scraping', [ScrapeApiController::class, 'scrape'])->name('scrape.query');
