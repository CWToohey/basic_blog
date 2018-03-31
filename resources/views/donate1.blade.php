@extends('layouts.master')

@section('content')
    <div class="donate">
        <h4>We appreciate your donation.</h4>

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
    <div id="PapPalTestMode" class="unFound">Note: PayPal payments are currently in test mode and will only work with test accounts. Please contact the candidate to make a donation.</div>
@endsection
