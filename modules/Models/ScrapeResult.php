<?php

namespace Modules\Models;

use Modules\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScrapeResult extends Model
{
    use HasFactory, Uuids;

    // protected $incrementing = false;

    protected $fillable = [
        'web_url',
        'selector',
        'scrape_result'
    ];

}
