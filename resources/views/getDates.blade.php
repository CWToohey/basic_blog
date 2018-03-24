@extends('layouts.master')

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
