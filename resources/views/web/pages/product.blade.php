@extends('web.master-product')
@section('content')

    <div id="container">
        <div class="container">
            <!-- Breadcrumb Start-->
            {{--<ul class="breadcrumb">--}}
                {{--<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="index.html" itemprop="url"><span itemprop="title"><i class="fa fa-home"></i></span></a></li>--}}
                {{--<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="category.html" itemprop="url"><span itemprop="title">الکترونیکی</span></a></li>--}}
                {{--<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="product.html" itemprop="url"><span itemprop="title">لپ تاپ ایلین ور</span></a></li>--}}
            {{--</ul>--}}
            <!-- Breadcrumb End-->
            <div class="row">
                <!--Middle Part Start-->
                <div id="content" class="col-sm-9">
                    <div itemscope itemtype="">
                        <h1 class="title" itemprop="name">{{\App\Providers\MyProvider::_text($product->title)}}</h1>
                        <div class="row product-info">
                            <div class="col-sm-6">
                                <div class="image"><img class="img-responsive" itemprop="image" id="zoom_01" src="{{$product->images["images"]["350"]}}" title="{{\App\Providers\MyProvider::_text($product->title)}}" alt="{{\App\Providers\MyProvider::_text($product->title)}}" data-zoom-image="{{$product->images["images"]["500"]}}" /> </div>
                                <div class="center-block text-center"><span class="zoom-gallery"><i class="fa fa-search"></i> {{__('web/public.click_on_image_for_zoom')}} </span></div>
                                <div class="image-additional" id="gallery_01"> <a class="thumbnail" href="#" data-zoom-image="{{$product->images["images"]["500"]}}" data-image="{{$product->images["images"]["350"]}}" title="لپ تاپ ایلین ور"> <img src="{{$product->images["images"]["66"]}}" title="لپ تاپ ایلین ور" alt = "لپ تاپ ایلین ور"/></a></div>
                                {{--<div class="image-additional" id="gallery_01"> <a class="thumbnail" href="#" data-zoom-image="{{$product->images["images"]["500"]}}" data-image="{{$product->images["images"]["350"]}}" title="لپ تاپ ایلین ور"> <img src="{{$product->images["images"]["66"]}}" title="لپ تاپ ایلین ور" alt = "لپ تاپ ایلین ور"/></a> <a class="thumbnail" href="#" data-zoom-image="{{$product->images["images"]["500"]}}" data-image="{{$product->images["images"]["350"]}}" title="لپ تاپ ایلین ور"><img src="{{$product->images["images"]["66"]}}" title="لپ تاپ ایلین ور" alt="لپ تاپ ایلین ور" /></a> <a class="thumbnail" href="#" data-zoom-image="image/product/macbook_air_2-500x500.jpg" data-image="image/product/macbook_air_2-350x350.jpg" title="لپ تاپ ایلین ور"><img src="image/product/macbook_air_2-66x66.jpg" title="لپ تاپ ایلین ور" alt="لپ تاپ ایلین ور" /></a> <a class="thumbnail" href="#" data-zoom-image="image/product/macbook_air_3-500x500.jpg" data-image="image/product/macbook_air_3-350x350.jpg" title="لپ تاپ ایلین ور"><img src="image/product/macbook_air_3-66x66.jpg" title="لپ تاپ ایلین ور" alt="لپ تاپ ایلین ور" /></a> </div>--}}

                            </div>
                            <div class="col-sm-6">
                                <ul class="list-unstyled description">
                                    <li><b>{{__('web/public.title')}} :</b> <a href="{{ route('web.show.product',$product->id) }}"><span itemprop="brand">{{\App\Providers\MyProvider::_text($product->title)}}</span></a></li>
                                    <li><b>{{__('web/public.id')}} :</b> <span itemprop="mpn">{{\App\Providers\MyProvider::_text($product->id)}}</span></li>
                                    <li><b>{{__('web/public.description')}} :</b> {!! \App\Providers\MyProvider::_text($product->description) !!}</li>
                                    <li><b>{{__('web/public.body')}} :</b> <span class="">{!! \App\Providers\MyProvider::_text($product->body)!!}</span></li>
                                </ul>
                                <ul class="price-box">
                                    <li class="price" itemprop="offers" itemscope itemtype="#">@if($product->discount>0)<span class="price-old">{{\App\Providers\MyProvider::exToLocal($product->price)}}{{__('web/public.currency_name_'.session('Local_Currency'))}}</span>  @endif <span itemprop="price">{{\App\Providers\MyProvider::exToLocalDiscount($product->price,$product->discount)}}{{__('web/public.currency_name_'.session('Local_Currency'))}}<span itemprop="availability" content="موجود"></span></span></li>

                                    <li></li>
                                    {{--<li>بدون مالیات : 9 میلیون تومان</li>--}}
                                </ul>
                                <div id="product">
                                    <h3 class="subtitle">انتخاب های در دسترس</h3>
                                    {{--<div class="form-group required">--}}
                                        {{--<label class="control-label">رنگ</label>--}}
                                        {{--<select class="form-control" id="input-option200" name="option[200]">--}}
                                            {{--<option value=""> --- لطفا انتخاب کنید --- </option>--}}
                                            {{--<option value="4">مشکی </option>--}}
                                            {{--<option value="3">نقره ای </option>--}}
                                            {{--<option value="1">سبز </option>--}}
                                            {{--<option value="2">آبی </option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                    <div class="cart">
                                        <div>
                                            {{--<div class="qty">--}}
                                                {{--<label class="control-label" for="input-quantity">تعداد</label>--}}
                                                {{--<input type="text" name="quantity" value="1" size="2" id="input-quantity" class="form-control" />--}}
                                                {{--<a class="qtyBtn plus" href="javascript:void(0);">+</a><br />--}}
                                                {{--<a class="qtyBtn mines" href="javascript:void(0);">-</a>--}}
                                                {{--<div class="clear"></div>--}}
                                            {{--</div>--}}
                                            <button type="button" id="button-cart" class="btn btn-primary btn-lg"> {{__('web/public.add_cart')}}</button>
                                        </div>
                                        {{--<div>--}}
                                            {{--<button type="button" class="wishlist" onClick=""><i class="fa fa-heart"></i> افزودن به علاقه مندی ها</button>--}}
                                            {{--<br />--}}
                                            {{--<button type="button" class="wishlist" onClick=""><i class="fa fa-exchange"></i> مقایسه این محصول</button>--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                                {{--<div class="rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">--}}
                                    {{--<meta itemprop="ratingValue" content="0" />--}}
                                    {{--<p><span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span> <a onClick="$('a[href=\'#tab-review\']').trigger('click'); return false;" href=""><span itemprop="reviewCount">1 بررسی</span></a> / <a onClick="$('a[href=\'#tab-review\']').trigger('click'); return false;" href="">یک بررسی بنویسید</a></p>--}}
                                {{--</div>--}}
                                {{--<hr>--}}
                                <!-- AddThis Button BEGIN -->
                                {{--<div class="addthis_toolbox addthis_default_style"> <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_google_plusone" g:plusone:size="medium"></a> <a class="addthis_button_pinterest_pinit" pi:pinit:layout="horizontal" pi:pinit:url="http://www.addthis.com/features/pinterest" pi:pinit:media="http://www.addthis.com/cms-content/images/features/pinterest-lg.png"></a> <a class="addthis_counter addthis_pill_style"></a> </div>--}}
                                {{--<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-514863386b357649"></script>--}}
                                <!-- AddThis Button END -->
                            </div>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab-description" data-toggle="tab">{{__('web/public.body')}}</a></li>
                            {{--<li><a href="#tab-specification" data-toggle="tab">مشخصات</a></li>--}}
                            {{--<li><a href="#tab-review" data-toggle="tab">بررسی (2)</a></li>--}}
                        </ul>
                        <div class="tab-content">
                            <div itemprop="description" id="tab-description" class="tab-pane active">
                                <div>
                                    {!! \App\Providers\MyProvider::_text($product->body)!!}
                                </div>
                            </div>
                            <div id="tab-specification" class="tab-pane">

                            </div>
                            <div id="tab-review" class="tab-pane">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Middle Part End -->
@endsection