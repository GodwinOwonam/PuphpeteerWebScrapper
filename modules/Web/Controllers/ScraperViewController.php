<?php

namespace Modules\Web\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Models\ScrapeResult;


class ScraperViewController extends Controller
{

    public function __construct()
    {

    }
    /**
     * Return the index view
     *
     * @return view
     */
    public function index()
    {

        $currentURL = Request()->getUri();

        $items = ScrapeResult::get()->toArray();

        $items = $this->paginate($items, 4);
        $items->setPath($currentURL.'');
        // dd($items->links()->path);

        // dd($items);
        return view('Scraper.index', compact('items'));
    }


    public function scrape_result($id)
    {
        $currentURL = Request()->getUri();
        // dd($currentURL);
        $data = ScrapeResult::find($id);
        $web_url = $data->web_url;
        $selector = $data->selector;

        $items = $data->scrape_result;
        $items = array(json_decode($items));
        // dd($item s);

        $final_array = [];

        foreach($items[0] as $item)
        {
            array_push($final_array, $item);
        }

        // dd($final_array);

        $selected = $this->paginate($final_array, 5);
        $selected->setPath($currentURL.' ');

        // dd($selected);

        // $final_data = collect($data);
        // dd($selected->links(), $currentURL);
        return view('Scraper.scraped', compact('web_url', 'selector', 'selected'));
    }

    public function paginate($items, $perPage = 4, $page = null)
    {

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $total = count($items);
        $currentPage = $page;
        $offset = ($currentPage * $perPage) - $perPage;
        $itemsToShow = array_slice($items, $offset, $perPage);

        return new LengthAwarePaginator($itemsToShow, $total, $perPage);

    }

    public function showError($message)
    {
        return view('Scraper.error', compact('message'));
    }

}
