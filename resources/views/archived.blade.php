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
        @endrole
        <div class="menuLinks"><a class="dropbtn" href="{{ URL::to('/') }}">&#8962;</a></div>

        <div class="menuLinks"><a class="shownArrow" href="{{ URL::to('/donate') }}">Donate</a></div>
        <div class="menuLinks">
            <div class="dropdown">
                <button class="dropbtn">&#9776;</button>
                <div class="dropdown-content">
                    @role('admin','shop-keeper')
                    <a href="{{ URL::to('/admin/logout') }}">Logout</a>
                    @else
                        <a href="{{ URL::to('/admin/login') }}">Login</a>
                        @endrole
                        <a href="{{ URL::to('/admin/register') }}">Register</a>
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
    <div class="pics"><img class="picsElement" src="images/images2.jpeg" alt="missing image"></div>
    <div class="searchBox">
        <input type="text" placeholder="  Search by keyword"><br>
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
