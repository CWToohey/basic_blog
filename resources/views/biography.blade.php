@extends('layouts.master')

@section('content')
    <div class="article">
        <?php
        $data = file_get_contents("biography.txt");
        echo nl2br($data);
        ?>
    </div>
@endsection
