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

    <div class="w-2/3 bg-white mx-auto h-72 my-16 rounded-md shadow-lg flex flex-col-reverse justify-around items-start text-center">
        <div class="text-blue-800 font-mono font-bold text-center text-2xl w-1/2 mx-auto">
            <h3>{{$message}}</h3>
        </div>

        <form action="{{route('home')}} " method="get" class="w-1/5 mx-auto">
            @csrf
            <button type="submit" class="w-14 h-12 p-1 rounded-md bg-red-600 text-white shadow-sm mt-2 hover:bg-white hover:border-blue-900 hover:shadow-md hover:text-red-900" id="scrape_btn">Back</button>
        </form>
    </div>
</body>
</html>
