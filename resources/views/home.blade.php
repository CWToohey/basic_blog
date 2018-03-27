@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    @if (session('status'))
                        <div class="panel-body">
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        </div>
                    @endif
                </div>
                @if(isset($missing))
                    <div class="myInputs">
                        <span class="donorError">{{ $missing }}</span>
                    </div>
                @endif
                <form action="{{ URL::to('addPost') }}{{ $extension }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input name="_method" type="hidden" value="{{ $method }}">

                    <div class="myInputs">
                        POST TITLE <input name="title" id="title" value="{{ $posted['title'] ?? '' }}"
                                          placeholder="Title here">
                        <?php
                        $checked = isset($posted['isBio']) ? ' checked ' : '';
                        ?>
                        <br>
                        <input type="checkbox" name="isBio" value="1"{{ $checked }}> Check to make this your biography.
                    </div>
                    <div class="myInputs">
                        PHOTO <input class="fileUpload" type="file" name="anImage" id="anImage">
                    </div>
                    @if(isset($posted['path']))
                        <div class="myInputs">
                            Choose a new file, or keep the existing image below.
                        </div>
                        <div class="myInputs">
                            <div id="testing" class="pics"><img class="picsElement"
                                                                src="{{ URL::to('/').'/'.$posted['path'] }}  "
                                                                alt="missing image"></div>
                        </div>
                    @endif
                    <div class="myInputs">
                        TEXT
                        <textarea id="textContent" name="textContent"
                                  placeholder="Text here">{{ $posted['content'] ?? '' }}</textarea>
                        <input type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
