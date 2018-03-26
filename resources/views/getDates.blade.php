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
    <div class="initialText">
        @if(isset($donors) && $donors > 1)
            <div class="donorGood">If live, information about {{ $donors }} donors would have been sent to you.</div>
        @elseif(isset($donors) && $donors == 1)
            <div class="donorGood">If live, information about a donor would have been sent to you.</div>
        @elseif(isset($donors))
            <div class="donorError">No donors were found in that time period.</div>
        @endif
    </div>
@endsection
