@extends('web.master')
@section('content')

    <div id="container">
        <div class="container">
            <div class="row">
                <!--Middle Part Start-->
                <div id="content" class="col-sm-12">
                    {!! \App\Providers\MyProvider::_text($page->body)!!}
                </div>
                <!--Middle Part End -->
            </div>
        </div>
    </div>
@endsection