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
    <div class="container">
        <div class="donate">
            <form action="{{ URL::to('donate') }}{{ $extension ?? '' }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input name="_method" type="hidden" value="{{ $method }}">

                <div class="myInputs">
                    <div class="InputLabel">
                        <label for="amount">Amount</label>
                    </div>
                    <input type="text" class="amount" name="amount" id="amount" value="{{ $posted['amount'] ?? '' }}"
                           placeholder='xx.xx'><span class="errors">{{ $posted['amount_err'] ?? '' }}</span>
                </div>

                <div class="myInputs">
                    <div class="InputLabel">
                        <label for="fullName">Name</label>
                    </div>
                    <input type="text" name="fullName" id="fullName" value="{{ $posted['fullName'] ?? '' }}"
                           placeholder='Name'><span class="errors">{{ $posted['fullName_err'] ?? '' }}</span>
                </div>
                <div class="myInputs">
                    <div class="InputLabel">
                        <label for="email">Email</label>
                    </div>
                    <input type="text" name="email" id="email" value="{{ $posted['email'] ?? '' }}"
                           placeholder='someone@somwhere.com'><span
                            class="errors">{{ $posted['email_err'] ?? '' }}</span>
                </div>
                <div class="myInputs">
                    <div class="InputLabel">
                        <label for="address">Address</label>
                    </div>
                    <input type="text" name="address" id="address" value="{{ $posted['address'] ?? '' }}"
                           placeholder='Home address'><span
                            class="errors">{{ $posted['address_err'] ?? '' }}</span>
                </div>
                <div class="myInputs">
                    <div class="InputLabel">
                        <label for="occupation">Occupation</label>
                    </div>
                    <input type="text" name="occupation" id="occupation"
                           value="{{ $posted['occupation'] ?? '' }}" placeholder='Occupation'><span
                            class="errors">{{ $posted['occupation_err'] ?? '' }}</span>
                </div>
                <div class="myInputs">
                    <div class="InputLabel">
                        <label for="employer">Employer</label>
                    </div>
                    <input type="text" name="employer" id="employer" value="{{ $posted['employer'] ?? '' }}"
                           placeholder='Employer'><span
                            class="errors">{{ $posted['employer_err'] ?? '' }}</span>
                </div>
                <input type="submit" value="Proceed to Checkout">
            </form>
        </div>
    </div>
@endsection
