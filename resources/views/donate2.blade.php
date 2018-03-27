@extends('layouts.donations')

@section('content')
    <div class="container" id="thankYou"></div>
    <div class="donate">
        <div class="donate2">
            <?php
            if (isset($data->amount)) {
                setlocale(LC_MONETARY, 'en_US');
                $amount = money_format('%i', $data->amount);
            }
            ?>
            <span class="donation">Amount: </span>$ {{ $amount ?? '' }}<br>
            <span class="donation">Name:</span> {{ $data->fullName ?? '' }}<br>
            <span class="donation">Email:</span> {{ $data->email ?? '' }}<br>
            <span class="donation">Address:</span> {{ $data->address ?? '' }}<br>
            <span class="donation">Occupation:</span> {{ $data->occupation ?? '' }}<br>
            <span class="donation">Employer:</span> {{ $data->employer ?? '' }}<br>
        </div>

        <div id="paypal-button-container"></div>
        <div class="payPalMessage">You can use a credit card through Paypal.</div>
    </div>
    <script>
        var paymentInfo = JSON.parse('<?php echo json_encode($data); ?>');
        var postUrl = "{{ URL::to('/donate') }}";
    </script>
@endsection
