@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                    @if (session('status'))
                    <div class="panel-body">
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    </div>
                    @endif
            </div>
            TITLE: {{ $title }}<br>EXT: {{ $extension }}<br>NAME: {{ $name }}
        </div>
    </div>
</div>
@endsection
