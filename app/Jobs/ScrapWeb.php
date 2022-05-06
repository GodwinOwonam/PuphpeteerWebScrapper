<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Nesk\Puphpeteer\Puppeteer;
use Nesk\Rialto\Data\JsFunction;


use App\Jobs\StoreScrape;
use Modules\Models\ScrapeResult;



class ScrapWeb implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $web_url;
    public $selector;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($web_url, $selector)
    {
        $this->web_url = $web_url;
        $this->selector = $selector;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // try {
            $puppeteer = new Puppeteer;
            $browser = $puppeteer->launch();

            $page = $browser->newPage();
            $page->goto($this->web_url);
            $elements = $page->querySelectorAll($this->selector);

            // Get the "viewport" of the page, as reported by the page.
            $value = $page->evaluate(JsFunction::createWithParameters(['selector'])
                                ->body("
                                        let elements = document.querySelectorAll(selector);
                                        let returnList = [];

                                        for(let i = 0; i < elements.length; i++)
                                        {
                                            returnList.push(elements[i].innerHTML.trim());

                                        }
                                        return returnList;
                                ")->scope(['selector' => $this->selector]));

            $scraped_data = ScrapeResult::create([
                'web_url' => $this->web_url,
                'selector' => $this->selector,
                'scrape_result' => json_encode($value)
            ]);
            $browser->close();
                // StoreScrape::dispatch($this->web_url, $this->selector, $elements);

        // } catch (\Throwable $th) {
        //     $message = "not found";
        //     return [
        //         'elements' => [],
        //         'message' => $message
        //     ];
        // }

    }
}
