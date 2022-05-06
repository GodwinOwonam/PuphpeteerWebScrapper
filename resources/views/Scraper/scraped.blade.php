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

    <div>
        <div>
            <h4 class="font-mono text-center text-2xl mt-3">Scrape Results</h4>
            <hr>
        </div>
        <div class="flex justify-end items-center h-16 rounded-sm shadow-lg w-11/12 mx-auto mb-4 p-2">
            <div class="w-2/5"><h4>Url: {{$web_url}}</h4></div>
            <div class="w-2/5"><h4>Selector: {{$selector}}</h4></div>
            <form action="{{route('home')}} " method="get" class="w-1/5">
                @csrf
                <button type="submit" class="w-14 h-12 p-1 rounded-md bg-red-600 text-white shadow-sm mt-2 hover:bg-white hover:border-blue-900 hover:shadow-md hover:text-red-900" id="scrape_btn">Back</button>
            </form>
        </div>
    </div>

    <div class="w-11/12 mx-auto">


        <div class="border-2 rounded-md w-full p-4">
            @if (isset($selected))
                <table class="w-full ">
                    <th>
                        <tr class="border-b-2 mb-7 border-gray-400 w-full">
                            <td class="border-l-2 pl-4 border-gray-400">Scrape Results</td>
                        </tr>
                    </th>

                    <tbody class="w-full">
                        @foreach ($selected as $items)
                            {{-- @foreach ($items as $item) --}}
                            <tr class="w-full">
                                <td class="py-2">{{json_encode($items)}}</td>
                            </tr>
                            {{-- @endforeach --}}

                        @endforeach
                    </tbody>
                </table>


            <p class="font-mono text-sm text-red-400 pt-10">{{$selected->links()}}</p>


            @endif
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{asset('js/scraper.js')}}"></script>
</body>
</html>
