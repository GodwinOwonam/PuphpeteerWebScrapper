<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web Scrapper With Puphpeteer</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>

    <div class="w-2/3 bg-white mx-auto h-72 my-16 rounded-md shadow-lg">
        <div class="text-blue-800 font-mono font-bold text-center text-lg">
            <h3>Web Scrapper</h3>
        </div>
        <form action="{{route('scrape.query')}}" method="post" class="w-10/12 mx-auto bg-white my-8" id="scraper_form">
            @csrf
            <div class="w-full mx-auto my-3">
                <label for="selector" class="w-full">Enter Css Selector</label> <br>
                <input type="text" id="selector" name="selector" class="w-full h-10 border-b-2 border-blue-800 outline-none" required/>
            </div>

            <div class="w-full mx-auto my-3">
                <label for="web_url">Enter Url</label> <br>
                <input type="url" id="web_url" name="web_url" class="w-full h-10 border-b-2 border-blue-800 outline-none" required/>
            </div>

            <button type="submit" class="w-24 h-12 p-1 rounded-md bg-blue-900 text-white shadow-sm mt-2 hover:bg-white hover:border-blue-900 hover:shadow-md hover:text-blue-900" id="scrape_btn">Scrape</button>
        </form>
    </div>

    <div class="w-11/12 mx-auto">
        <h4 class="font-mono text-center text-2xl">Results will go here</h4>
        <hr>

        <div class="border-2 rounded-md w-full p-4">
            @if (! isset($items))
                <table class="w-full ">
                    <th>
                        <tr class="border-b-2 mb-7 border-gray-400 w-full">
                            <td>Url</td>
                            <td class="border-l-2 pl-4 border-gray-400">Element</td>
                            <td class="border-l-2 pl-4 border-gray-400">Scrape Result</td>
                        </tr>
                    </th>
                    <tbody class="w-full">
                        <tr class="w-full">
                            <td colspan="2" class="text-center py-6" id="scraping_message">No results yet</td>
                        </tr>
                    </tbody>
                </table>


            @else

                <table class="w-full ">
                    <th>
                        <tr class="border-b-2 mb-7 border-gray-400 w-full">
                            <td>Url</td>
                            <td class="border-l-2 pl-4 border-gray-400">Selector</td>
                            <td class="border-l-2 pl-4 border-gray-400">Action</td>

                        </tr>
                    </th>
                    <tbody class="w-full">
                        @foreach ($items as $item)
                        <tr class="w-full">
                            <td class="py-2">{{$item['web_url']}}</td>
                            <td class="py-2">{{$item['selector']}}</td>

                            <td class="py-2">
                                <form action="{{route('scrape.results', $item['id'])}} " method="get">
                                    @csrf
                                    <button type="submit" class="w-24 h-12 p-1 rounded-md bg-blue-900 text-white shadow-sm mt-2 hover:bg-white hover:border-blue-900 hover:shadow-md hover:text-blue-900" id="scrape_btn">Details</button>
                                </form>
                            </td>

                        </tr>

                        @endforeach
                    </tbody>
                </table>


            <p class="font-mono text-sm text-red-400 pt-10">{{$items->links() }}</p>


            @endif
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{asset('js/scraper.js')}}"></script>
</body>
</html>
