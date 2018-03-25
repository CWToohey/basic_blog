@extends('layouts.master')
<?php
$leftArrow = $lastId - $archiveCount - 1;
$leftArrow >= 0 ? $leftArrow : 0;
$rightArrow = $lastId;
?>

@section('content')
    <?php
    if (isset($notFound)) $val = $notFound; else $val = '';
    ?>
    <div class="searchBox">
        <form method="post" action="{{ URL::to('/search') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="text" name="searchFor" placeholder="  Search by keyword" value="{{ $val }}">
            <input type="submit" value="Search">
        </form>
        @if(isset($notFound) && $notFound != '')
            <span class="unFound">Keyword not found. Please try again.</span>
        @endif
    </div>
    @foreach($posts as $post)
        <div class="archives">
            <div class="titleLink">
                <a class="shownArrow" href="./changePost?id={{ $post['id'] }}">{{ $post['title'] }}
                    <?php
                    $created = $post['isPost'] ? "&#9679; " . date('Y-m-d', strtotime($post['created_at'])) : '';
                    ?>
                    {{ $created }}</a>
            </div>
            <div class="initialText">
                <?php
                $output = '';
                $words = explode(' ', $post['content']);
                for ($i = 0; $i < count($words) && $i < 15; $i++) {
                    $output .= $words[$i] . " ";
                }
                echo substr($output, 0, -1);
                ?>...
            </div>
            <div class="clearFix"></div>
        </div>
    @endforeach
@endsection
