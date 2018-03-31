<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A blog for political candidates.">
    <meta name="keywords" content="political candidate vote voting">

    <link href="https://fonts.googleapis.com/css?family=Raleway:500" rel="stylesheet">

    <?php
    $heading = \App\headings::where('key', '=', 'PageHeading')->first();
    $subHead = \App\headings::where('key', '=', 'PageSubHead')->first();
    ?>
    <title>{{ $heading->content }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/css/app.css">

<body>


<div id="top">
    <div class="container">

        <div class="navLeft">
            @if(!isset($first) || $first)
                <div class="item"><a class="hiddenArrow" href="#">&#9664;</a></div>
            @else
                <div class="item"><a class="shownArrow" href="./changePost?id={{ $id }}&prev=Previous">&#9664;</a></div>
            @endif
        </div>
        <div class="navMiddle">
            <ul id="nav">
                <li>
                    <a href="#">Menu</a>
                    <ul>
                        @role('admin')
                        <li><a href="{{ URL::to('/addPost') }}">Add Post</a></li>
                        <li><a href="{{ URL::to('/') }}">Posts</a></li>
                        <li><a href="{{ URL::to('/archives') }}">Archives</a></li>
                        <li><a href="{{ URL::to('/biography') }}">About</a></li>
                        <li><a href="{{ URL::to('/editTitles') }}">Edit Web Titles</a></li>
                        <li><a href="{{ URL::to('/findDonations') }}">Donors</a></li>
                        <li><a href="{{ URL::to('/admin/logout') }}">Logout</a></li>
                        @else
                            <li><a href="{{ URL::to('/biography') }}">About</a></li>
                            <li><a href="{{ URL::to('/') }}/donate">Donate</a></li>
                            <li><a href="{{ URL::to('/') }}">Posts</a></li>
                            <li><a href="{{ URL::to('/archives') }}">Archives</a></li>
                            <li><a href="{{ URL::to('/contact') }}">Contact</a></li>
                            <li><a href="{{ URL::to('/admin/login') }}">Login</a></li>
                            @endrole
                    </ul>
                </li>
            </ul>
        </div>
        <div class="navRight">
            @if(isset($last) && !$last)
                <div class="item"><a class="shownArrow" href="./changePost?id={{ $id }}&next=Next">&#9654;</a>
                </div>
            @else
                <div class="item"><a class="hiddenArrow" href="#">&#9654;</a></div>
            @endif
        </div>
    </div>
</div>

<div class="container container2">
    <div class="buffered">
        <h1>{{ $heading->content }}</h1>

        <h3>{{ $subHead->content }}</h3>
        @yield('content')
    </div>
    <div class="article">
        <h3><a class="shownArrow" href="{{ URL::to('/') }}">Posts</a> | <a class="footers"
                                                                           href="{{ URL::to('/') }}/donate">Donate</a> |
            <a class="footers"
               href="{{ URL::to('/') }}/archives">Archives</a>
        </h3>
    </div>
</div>
</body>
</html>

