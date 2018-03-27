<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
        <div class="evenly">
            @if(!isset($first) || $first)
                <div class="item"><a class="hiddenArrow" href="#">&#9664;</a></div>
            @else
                <div class="item"><a class="shownArrow" href="./changePost?id={{ $id }}&prev=Previous">&#9664;</a></div>
            @endif

            @role('admin')
            <div class="menuLinks"><a class="shownArrow" href="{{ URL::to('/addPost') }}">Add Post</a></div>
            @else
                <div class="menuLinks"><a class="shownArrow" href="{{ URL::to('/biography') }}">About</a></div>
                @endrole

                <div class="menuLinks">
                    <div class="dropdown">
                        <button class="dropbtn dropBtnPos">&#9776;</button>
                        <div class="dropdown-content">
                            <a href="{{ URL::to('/') }}">Home</a>
                            <a href="{{ URL::to('/archives') }}">Archives</a>
                            <a href="{{ URL::to('/biography') }}">About</a>
                            @role('admin','shop-keeper')
                            <a href="{{ URL::to('/editTitles') }}">Edit Web Titles</a>
                            <a href="{{ URL::to('/admin/logout') }}">Logout</a>
                            @else
                                <a href="{{ URL::to('/') }}/donate">Donate</a>
                                <a href="{{ URL::to('/contact') }}">Contact</a>
                                <a href="{{ URL::to('/admin/login') }}">Login</a>
                                {{--<a href="{{ URL::to('/admin/register') }}">Register</a>--}}
                                @endrole
                        </div>
                    </div>
                </div>
                @role('admin')
                <div class="menuLinks"><a class="shownArrow" href="{{ URL::to('/findDonations') }}">Donors</a></div>
                @else
                    <div class="menuLinks"><a class="shownArrow" href="{{ URL::to('/donate') }}">Donate</a></div>
                    @endrole

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
        <h3><a class="shownArrow" href="{{ URL::to('/') }}">Home</a> | <a class="shownArrow"
                                                                          href="{{ URL::to('/') }}/donate">Donate</a> |
            <a class="shownArrow"
               href="{{ URL::to('/') }}/archives">Archives</a>
        </h3>
    </div>
</div>
</body>
</html>

