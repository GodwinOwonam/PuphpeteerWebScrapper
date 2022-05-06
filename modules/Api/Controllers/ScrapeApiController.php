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

        ScrapeApiController::callPuphpeteer($web_url, $selector);



        // $data_already_exists = $this->scrapeExists($web_url, $selector);
        // if(!$data_already_exists)
        // {
        //     return redirect()->route('scrape.error', "not found");

        // }

        // return redirect()->route('scrape.results', $data_already_exists->id);


    }

    /**
     * Call the puphpeteer api
     */
    public static function callPuphpeteer(string $web_url, string $selector)
    {

        ScrapWeb::dispatchSync($web_url, $selector);

        // $puppeteer = new Puppeteer;
        // $browser = $puppeteer->launch();

        // $page = $browser->newPage();
        // $page->goto($web_url);
        // $elements = $page->querySelectorAll($selector);

        // // Get the "viewport" of the page, as reported by the page.
        // $value = $page->evaluate(JsFunction::createWithParameters(['selector'])
        //                     ->body("
        //                             let elements = document.querySelectorAll(selector);
        //                             let returnList = [];

        //                             for(let i = 0; i < elements.length; i++)
        //                             {
        //                                 returnList.push(elements[i].innerHTML.trim());
        //                             }
        //                             return returnList;
        //                     ")->scope(['selector' => $selector]));

        // // $results = [];
        // // foreach($elements as $element)
        // // {
        // //     $value = $page->evaluate(JsFunction::createWithParameters(['element'])
        // //                     ->body("
        // //                             return element.innerText;
        // //                     ")->scope(['element' => $element]));
        // //     if(isset($value) and $value !== null)
        // //     {
        // //         array_push($results, $value);
        // //     }
        // // }

        // // if(count($results) > 0)
        // // {
            // $scraped_data = ScrapeResult::create([
            //     'web_url' => $web_url,
            //     'selector' => $selector,
            //     'scrape_result' => json_encode($value)
            // ]);
        // // }

        // $browser->close();

        // // if($response['message'] !== "found"){
        // //     return redirect()->route('scrape.error', $response['message']);
        // // }

        // // // try{
        // //     $puppeteer = new Puppeteer;
        // // $browser = $puppeteer->launch();

        // // $page = $browser->newPage();
        // // $page->goto($web_url);
        // // $elements = $page->querySelectorAll($selector);
        // // if(!(count($elements) > 0) ){
        // //     return redirect()->route('scrape.error', "not found");
        // // }
        // // $browser->close();
        // // dd($elements);
        // // // }
        // // // catch(FatalException $ex){
        // // //     return redirect()->route('scrape.error', $ex->getMessage());
        // // // }
        // // // return $response['elements'];


        // // return $elements;
    }

    public function scrapeExists($web_url, $selector){
        return $data_already_exists = ScrapeResult::where('web_url', $web_url)->where('selector', $selector)->first();
    }

}
