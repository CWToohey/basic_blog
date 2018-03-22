@extends('layouts.master')
<?php
$leftArrow = $lastId - $archiveCount - 1;
$leftArrow >= 0 ? $leftArrow : 0;
$rightArrow = $lastId;
?>

@section('linkBar')
    <div class="evenly">
        <div class="item">
            @if($lastId > 0)
                <a class="shownArrow" href="{{ URL::to('/') }}/archives?lastId={{ $leftArrow }}&dir=L">&#9664;</a>
            @else
                <a class="hiddenArrow" href="#">&#9664;</a>
            @endif
        </div>
        @role('admin')
        <div class="menuLinks"><a class="shownArrow" href="{{ URL::to('/addPost') }}">Add Post</a></div>
        <div class="menuLinks"><a class="shownArrow" href="{{ URL::to('/findDonations') }}">Donors</a></div>
        @else
            <div class="menuLinks"><a class="shownArrow" href="{{ URL::to('/biography') }}">Biography</a></div>
            @endrole

        <div class="menuLinks"><a class="dropbtn" href="{{ URL::to('/') }}">&#8962;</a></div>

        <div class="menuLinks"><a class="shownArrow" href="{{ URL::to('/donate') }}">Donate</a></div>
        <div class="menuLinks">
            <div class="dropdown">
                <button class="dropbtn dropBtnPos">&#9776;</button>
                <div class="dropdown-content">
                    @role('admin','shop-keeper')
                    <a href="{{ URL::to('/admin/logout') }}">Logout</a>
                    @else
                        <a href="{{ URL::to('/admin/login') }}">Login</a>
                        @endrole
                        <a href="{{ URL::to('/') }}/archives">Archives</a>
                        <a href="{{ URL::to('/') }}/donate">Donate</a>
                </div>
            </div>
        </div>
        <div class="item">
            @if($rightArrow)
                <a class="shownArrow" href="{{ URL::to('/') }}/archives?lastId={{ $rightArrow }}&dir=R">&#9654;</a>
            @else
                <a class="hiddenArrow" href="{{ URL::to('/') }}/archives?lastId={{ $rightArrow }}&dir=R">&#9654;</a>
            @endif
        </div>
    </div>
@endsection

@section('content')
    <div class="searchBox">
        <form method="post" action="{{ URL::to('/search') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="text" name="searchFor" placeholder="  Search by keyword">
            <input type="submit" value="Search">
        </form>
    </div>
    @foreach($posts as $post)
        <div class="archives">
            <div class="titleLink">
                <a class="shownArrow" href="./changePost?id={{ $post['id'] }}">{{ $post['title'] }} &#9679;
                    <?php
                    $created = date('Y-m-d', strtotime($post['created_at']));
                    ?>
                    {{ $created }}</a>
            </div>
            <div class="initialText">
                <?php
                $words = explode(' ', $post['content']);
                for ($i = 0; $i < count($words) && $i < 10; $i++) {
                    echo $words[$i] . " ";
                }
                ?>...
            </div>
            <div class="clearFix"></div>
        </div>
    @endforeach
@endsection
