<?php

namespace Modules\Api\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Modules\Models\ScrapeResult;
use App\Jobs\ScrapWeb;
use Nesk\Puphpeteer\Puppeteer;
use Nesk\Rialto\Exceptions\Node\FatalException;
use Nesk\Rialto\Data\JsFunction;

use Illuminate\Http\Request;


class ScrapeApiController extends Controller
{
    /**
     * Return get the scrape result
     *
     * @param \Illuminate\Http\Request
     *
     * @return array
     */
    public function scrape(Request $request)
    {
        // return $request;
        $request->validate([
            'web_url' => ['required'],
            'selector' => ['string', 'required']
        ]);

        $web_url = $request->web_url;
        $selector = $request->selector;

        $data_already_exists = $this->scrapeExists($web_url, $selector);
        if($data_already_exists)
        {
            return redirect()->route('scrape.results',$data_already_exists->id);

        }
        ScrapWeb::dispatchSync($web_url, $selector);



    }


    public function scrapeExists($web_url, $selector){
        return $data_already_exists = ScrapeResult::where('web_url', $web_url)->where('selector', $selector)->first();
    }

}
