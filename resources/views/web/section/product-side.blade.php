
    <div id="container">
        <!-- Feature Box Start-->
        <div class="container">
            <div class="custom-feature-box row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="feature-box fbox_1">
                        <div class="title">ارسال رایگان</div>
                        <p>برای خرید های بیش از 500 هزار تومان</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="feature-box fbox_2">
                        <div class="title">assen</div>
                        <p>به زودی راه اندازی خواهد شد ...</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="feature-box fbox_3">
                        <div class="title">تخفیف ویژه</div>
                        <p>بهترین هدیه شما</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="feature-box fbox_4">
                        <div class="title">امتیازات خرید</div>
                        <p>از هر خرید امتیاز کسب کرده و از آن بهره بگیرید</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Feature Box End-->
        <div class="container">
            <div class="row">
                <!-- Left Part Start-->
                <aside id="column-left" class="col-sm-3 hidden-xs">
                    <h3 class="subtitle"> {{__('web/public.categories')}}</h3>
                    <div class="box-category">
                        <ul id="cat_accordion">
                            @foreach($categoriesProvider as $category)
                                @if($category->parent_id==0)
                                    <li><a href="{{ route('web.show.category',$category->id) }}">{{\App\Providers\MyProvider::_text($category->title)}}
                                            @if(isset($category->children[0]) and $category->children!=[])</a><span class="down"></span>
                                        <ul>
                                            <x-web-show-categories-sidebar :categories="$category->children">
                                            </x-web-show-categories-sidebar>
                                        </ul>
                                        @else
                                        </a>
                                        @endif
                                    </li>
                                @endif
                            @endforeach


                        </ul>


                    </div>
                    @if(isset($specialProducts))
                        <h3 class="subtitle">{{__('web/public.product_vip')}}</h3>
                        @foreach($specialProducts as $product)
                            <div class="side-item">
                                <div class="product-thumb clearfix">
                                    <div class="image"><a href="{{ route('web.show.product',$product->id) }}"><img src="{{$product->images["images"]["50"]}}" alt="{{\App\Providers\MyProvider::_text($product->title)}}" title="{{\App\Providers\MyProvider::_text($product->title)}} " class="img-responsive" /></a></div>
                                    <div class="caption">
                                        <h4><a href="{{ route('web.show.product',$product->id) }}">{{\App\Providers\MyProvider::_text($product->title)}}</a></h4>
                                        <p class="price"> <span class="price-new">{{\App\Providers\MyProvider::exToLocalDiscount($product->price,$product->discount)}}{{__('web/public.currency_name_'.session('Local_Currency'))}}</span> @if($product->discount>0)<span class="price-old">{{\App\Providers\MyProvider::exToLocal($product->price)}}{{__('web/public.currency_name_'.session('Local_Currency'))}}</span> <span class="saving">-{{$product->discount}}%</span> @endif</p>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @endif

                    @if(isset($newProducts))
                        <h3 class="subtitle">{{__('web/public.product_new')}}</h3>
                        @foreach($newProducts as $product)
                            <div class="side-item">
                                <div class="product-thumb clearfix">
                                    <div class="image"><a href="{{ route('web.show.product',$product->id) }}"><img src="{{$product->images["images"]["50"]}}" alt="{{\App\Providers\MyProvider::_text($product->title)}}" title="{{\App\Providers\MyProvider::_text($product->title)}} " class="img-responsive" /></a></div>
                                    <div class="caption">
                                        <h4><a href="{{ route('web.show.product',$product->id) }}">{{\App\Providers\MyProvider::_text($product->title)}}</a></h4>
                                        <p class="price"> <span class="price-new">{{\App\Providers\MyProvider::exToLocalDiscount($product->price,$product->discount)}}{{__('web/public.currency_name_'.session('Local_Currency'))}}</span> @if($product->discount>0)<span class="price-old">{{\App\Providers\MyProvider::exToLocal($product->price)}}{{__('web/public.currency_name_'.session('Local_Currency'))}}</span> <span class="saving">-{{$product->discount}}%</span> @endif</p>
                                    </div>
                                </div>

                            </div>

@endforeach
@endif
                </aside>
