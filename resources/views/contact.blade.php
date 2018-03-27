@extends('layouts.master')

@section('content')
    <div class="donate">
        <h3>Contact us</h3>

        <form id="contactForm" action="{{ URL::to('contact') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input name="_method" type="hidden" value="POST">

            <div class="myInputs">
                <div class="InputLabel">
                    <label for="FullName">Name</label>
                </div>
                <input type="text" class="amount" name="FullName" id="FullName" value="{{ $posted['FullName'] ?? '' }}">
                <span class="errors" id="FullNameErr">{{ $posted['FullName_err'] ?? '' }}</span>
            </div>
            <div class="myInputs">
                <div class="InputLabel">
                    <label for="email">Email</label>
                </div>
                <input type="text" class="amount" name="email" id="email" value="{{ $posted['email'] ?? '' }}">
                <span class="errors" id="emailErr">{{ $posted['email_err'] ?? '' }}</span>
            </div>
            <div class="myInputs">
                <div class="InputLabel">
                    <label for="phone">Phone</label>
                </div>
                <input type="text" class="amount" name="phone" id="phone" value="{{ $posted['phone'] ?? '' }}">
                <span class="errors" id="phoneErr">{{ $posted['phone_err'] ?? '' }}</span>
            </div>
            <div class="myInputs">
                <div class="InputLabel">
                    <label for="address">Address</label>
                </div>
                <input type="text" class="amount" name="address" id="address" value="{{ $posted['address'] ?? '' }}">
                <span class="errors" id="addressErr">{{ $posted['address_err'] ?? '' }}</span>
            </div>
            <div class="myInputs">
                <div class="InputLabel">
                    <label for="message">Message</label>
                </div>
                <input type="text" class="amount" name="message" id="message" value="{{ $posted['message'] ?? '' }}">
                <span class="errors" id="messageErr">{{ $posted['message_err'] ?? '' }}</span>
            </div>
            <div class="myInputs">
                To show you're human, enter <span id="num1"></span> <span id="operation"></span> <span id="num2"></span>:
                <input type="text" name="captcha" class="amount" id="captchaResponse">
                <span class="errors" id="fixCaptcha"></span>
            </div>
            <button class="editButton" onclick="getCaptcha(); return false;">Send message</button>
        </form>
    </div>
    <script src="{{ URL::to('/js/captcha.js') }}"></script>
@endsection
