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
    <?php
    $content = nl2br($content);
    $pictures = '';
    if (isset($pics) && is_array($pics)) {
        foreach ($pics as $pic) {
            //$pictures .= '<div class="pics"><img class="picsElement" src="images" alt="missing image"></div>';
            $pictures .= '<div id="testing" class="pics"><img class="picsElement" src="' . $pic . '" alt="missing image"></div>';
        }
    }
    echo $pictures;
    ?>
    @role('admin')
    <br>
    <div class="myButton">
        <button class="editButton" onclick="window.location.href='{{ URL::to('/edit/'.$id) }}'">Edit this post</button>
    </div>
    <div class="myButton">
        <form method="post" action="{{ URL::to('/edit/'.$id) }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input name="_method" type="hidden" value="delete">
            <input type="submit" value="Delete this post">
        </form>
    </div>
    @endrole
    <h2>{{ $subtitle }}</h2>
    <div class="article">
        <?php echo $content; ?>
    </div>
@endsection
