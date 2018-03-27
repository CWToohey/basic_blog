@extends('layouts.master')

@section('content')
    <form class="noBreak" id="contactForm" action="{{ URL::to('editTitles') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input name="_method" type="hidden" value="POST">
        @foreach($headings as $heading)
            <div class="myInputs">
                <div class="InputLabel">
                    <label for="{{ $heading['key'] }}">{{ $heading['label'] }}</label>
                </div>
                <input type="text" class="amount" name="{{ $heading['key'] }}" id="{{ $heading['id'] }}" value="{{ $heading['content'] }}">
            </div>
        @endforeach
        <input type="submit" value="Submit">
    </form>
    <button class="editButton" onclick="window.location.href='{{ URL::to('/') }}/'">Home</button>
@endsection
