@extends('web.master')
@section('content')
    <div class="main-inner-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-inner-banner-cont">
                        <div class="main-inner-banner-c-title">
                            <ul class="main-breadcrumb">
                                <li><a href="{{ route('web.home') }}">{{__('web/public.home_page')}}</a></li>
                                {{--<li class="active">{{\App\Providers\MyProvider::_text($product->title)}}</li>--}}
                            </ul>
                            {{--<h1 class="main-inner-banner-ct-name">{{__('web/public.complaint')}}</h1>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start: Inner main -->
    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="container p-3 my-3 bg-primary text-white align-center">
                    <h1><a href="{{\App\Providers\MyProvider::_text($siteDetailsProvider["box_fields_link"]->value)}}">{!! \App\Providers\MyProvider::_text($siteDetailsProvider["box_fields_body"]->value) !!}</a></h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Start: Inner main -->
    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                {!! \App\Providers\MyProvider::_text($siteDetailsProvider["page_fields_body"]->value) !!}
            </div>
        </div>
    </section>
    <!-- Start: Inner main -->
    <section class="bu-inner-main">
        <div class="container">
            @php  $style=array("1"=>"list-group-item list-group-item-danger",
            "2"=>"list-group-item list-group-item-success",
            "3"=>"list-group-item list-group-item-info",
            "4"=>"list-group-item list-group-item-warning",
            "5"=>"list-group-item list-group-item-secondary",
            );
            $style2=array("1"=>"list-group-item list-group-item-light",
            "2"=>"list-group-item list-group-item-dark",
            );
            $i=1;
            @endphp
            <ul class="list-group">
                @foreach($allField as $key=>$item)
                    @if($item->parent_id==0 and !isset($item->children[1]))
                        <li class="{{$style[$i%5+1]}}"><a href="{{ route('web.show.field',$item->id) }}">{{\App\Providers\MyProvider::_text($item->title)}}</a></li>
                        @php
                            $i++;
                        @endphp
                    @endif
                    @if($item->parent_id==0 and isset($item->children[1]))
                            <li class="{{$style[$i%5+1]}}"><h3><i class="fa fa-arrow-left" aria-hidden="true"></i><a href="{{ route('web.show.field',$item->id) }}">{{\App\Providers\MyProvider::_text($item->title)}}</a></h3>
                            @php
                                $y=1;
                            @endphp
                            <ul class="list-group">
                                @foreach ($item->children as $child)

                                    <li class="{{$style2[$y%2+1]}}"><a href="{{ route('web.show.field',$child->id) }}">{{\App\Providers\MyProvider::_text($child->title)}}</a></li>

                                    @php
                                        $y++;
                                    @endphp
                                @endforeach

                            </ul>
                        </li>

                        @php
                            $i++;
                        @endphp
                    @endif
                @endforeach

            </ul>


        </div>
    </section>





@endsection