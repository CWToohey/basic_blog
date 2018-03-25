@extends('layouts.donations')

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
            <span class="payPalMessage">You can use a credit card through Paypal.</span>
        </div>
    </div>
    <script>
        var paymentInfo = JSON.parse('<?php echo json_encode($data); ?>');
        var postUrl = "{{ URL::to('/donate') }}";
    </script>
@endsection
