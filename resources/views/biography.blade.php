@extends('layouts.master')

@section('linkBar')
    <div class="evenly">
        @if(!$first)
            <div class="item"><a class="shownArrow" href="./changePost?id={{ $id }}&prev=Previous">&#9664;</a></div>
        @else
            <div class="item"><a class="hiddenArrow" href="#">&#9664;</a></div>
        @endif

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
            @if(!$last)
                <div class="item"><a class="shownArrow" href="./changePost?id={{ $id }}&next=Next">&#9654;</a></div>
            @else
                <div class="item"><a class="hiddenArrow" href="#">&#9654;</a></div>
            @endif
    </div>
@endsection

@section('content')
    <?php
    $data = file_get_contents("biography.txt");
    echo nl2br($data);
    ?>
@endsection
