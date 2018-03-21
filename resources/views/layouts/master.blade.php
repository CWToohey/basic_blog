<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ getenv('BLOG_TITLE') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/css/app.css">

    <script src="{{ URL::to('/js') }}/menu.js"></script>

<body>
<div id="top">
    <div class="container">@yield('linkBar')</div>
</div>
<div class="container container2">
    <div class="buffered">
        <h1>{{ getenv('BLOG_TITLE') }}</h1>
        <h3>{{ getenv('BLOG_SUBHEAD') }}</h3>
        @yield('content')
    </div>
    <div class="article">
        <h3><a class="shownArrow" href="{{ URL::to('/') }}/donate">Donate!</a> | <a class="shownArrow" href="{{ URL::to('/') }}/archives">Archives</a></h3>
    </div>
</div>
</body>
</html>

