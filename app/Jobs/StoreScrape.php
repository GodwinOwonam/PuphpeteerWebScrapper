<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\QueryException;


use Modules\Models\ScrapeResult;

class StoreScrape implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $scrapeResult, $web_url, $selector, $elements;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ScrapeResult $scrapeResult, $web_url, $selector, array $elements)
    {
        $this->scrapeResult = $scrapeResult;
        $this->web_url = $web_url;
        $this->selector;
        $this->elements  = $elements;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {

            $scraped_data = ScrapeResult::create([
                'web_url' => $this->web_url,
                'selector' => $this->selector,
                'scrape_result' => json_encode($this->elements)
            ]);
        } catch (QueryException $th) {
            return $th->getMessage();
        }
    }
}
