@extends('layouts.master')

@section('content')
    <script src="{{ URL::to('/js') }}/sure.js"></script>
    <?php

    $content = nl2br($content);
    $pictures = '';
    if (isset($pics) && is_array($pics)) {
        foreach ($pics as $pic) {
            //$pictures .= '<div class="pics"><img class="picsElement" src="images" alt="missing image"></div>';
            $pictures .= '<div id="testing" class="pics"><img class="picsElement" src="' . $pic . '" alt="missing image"></div>';
        }
    }
    echo $pictures;
    ?>
    @role('admin')
    <br>
    <div class="myButton">
        <button class="editButton" onclick="window.location.href='{{ URL::to('/edit/'.$id) }}'">Edit this post</button>
    </div>
    <div class="myButton">
        <form method="post" action="{{ URL::to('/edit/'.$id) }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input name="_method" type="hidden" value="delete">
            <button class="editButton" onclick="return areYouSure();">Delete this post</button>
        </form>
    </div>
    @endrole
    <h2>{{ $subtitle }}</h2>
    <div class="article">
        <?php echo $content; ?>
    </div>
@endsection
