<?php


use Illuminate\Support\Facades\Route;
use Modules\Web\Controllers\ScraperViewController;


Route::get('/', [ScraperViewController::class, 'index'])->name('home');
Route::get('/scrape-results/{id}', [ScraperViewController::class, 'scrape_result'])->name('scrape.results');

Route::get('/data-exist/{web_url}/{selector}', [ScraperViewController::class, 'dataExists'])->name('scrape.data.exists');

Route::get('/scrape-error/{message}', [ScraperViewController::class, 'showError'])->name('scrape.error');
