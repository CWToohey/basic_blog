<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
    $heading = \App\headings::where('key', '=', 'PageHeading')->first();
    $subHead = \App\headings::where('key', '=', 'PageSubHead')->first();
    ?>
    <title>{{ $heading->content }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/css/app.css">

    <!--Scripts -->
    <script   src="https://code.jquery.com/jquery-3.3.1.min.js"   integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="   crossorigin="anonymous"></script>
    <script src="{{ URL::to('/js/menu.js') }}"></script>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>

    <script src="{{ URL::to('/js/donations.js') }}"></script>

<body>
<div id="top">
    <div class="container">@yield('linkBar')</div>
</div>
<div class="container container2">
    <div class="buffered">
        <h1>{{ $heading->content }}</h1>
        <h3>{{ $subHead->content }}</h3>
        @yield('content')
    </div>
    <div class="article">
        <h3><a class="shownArrow" href="{{ URL::to('/') }}">Home</a> |
            <a class="shownArrow"
               href="{{ URL::to('/') }}/archives">Archives</a>
        </h3>
    </div>
</div>
</body>
</html>

