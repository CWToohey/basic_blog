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
                <button class="dropbtn">&#9776;</button>
                <div class="dropdown-content">
                    @role('admin','shop-keeper')
                    <a href="{{ URL::to('/admin/logout') }}">Logout</a>
                    @else
                        <a href="{{ URL::to('/admin/login') }}">Login</a>
                        {{--<a href="{{ URL::to('/admin/register') }}">Register</a>--}}
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
    <div class="container">
        <div class="donate">
            <form action="{{ URL::to('findDonations') }}{{ $extension ?? '' }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input name="_method" type="hidden" value="POST">

                <div class="myInputs">
                    <div class="InputLabel">
                        <label for="starting">Start Date</label>
                    </div>
                    <input type="text" class="amount" name="starting" id="starting" value="{{ $posted['starting'] ?? '' }}">
                    <span class="errors">{{ $posted['starting_err'] ?? '' }}</span>
                </div>
                <div class="myInputs">
                    <div class="InputLabel">
                        <label for="ending">End Date</label>
                    </div>
                    <input type="text" class="amount" name="ending" id="ending" value="{{ $posted['ending'] ?? '' }}">
                    <span class="errors">{{ $posted['ending_err'] ?? '' }}</span>
                </div>
                <input type="submit" value="Get donors">
            </form>
        </div>
    </div>
    @if(isset($donors))
        {{ $donors }} have been sent to you.
        <?php
        var_dump($test);
        ?>
    @endif


@endsection
