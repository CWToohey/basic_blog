@extends('layouts.donations')

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
    <div class="container" id="thankYou"></div>
    <div class="container">
        <div class="donate">
            <div class="donate2">
                <?php
                if(isset($data->amount)) {
                    setlocale(LC_MONETARY, 'en_US');
                    $amount = money_format('%i', $data->amount);
                }
                ?>
                Amount: $ {{ $amount ?? '' }}<br>
                Name: {{ $data->fullName ?? '' }}<br>
                Email: {{ $data->email ?? '' }}<br>
                Address: {{ $data->address ?? '' }}<br>
                Occupation: {{ $data->occupation ?? '' }}<br>
                Employer: {{ $data->employer ?? '' }}<br>
            </div>

            <div id="paypal-button-container"></div>
            You can use a credit card through Paypal.
        </div>
    </div>
    <script>
        var paymentInfo = JSON.parse('<?php echo json_encode($data); ?>');
        var postUrl = "{{ URL::to('/donate') }}";
    </script>
@endsection
