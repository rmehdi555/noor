@if(isset($category->products[0]) and $category->products!=[])
    @foreach($category->products as $product)


        <div class="product-layout product-list col-xs-12">
            <div class="product-thumb">
                <div class="image"><a href="{{ route('web.show.product',$product->id) }}"><img src="{{$product->images["images"]["200"]}}" alt="{{\App\Providers\MyProvider::_text($product->title)}}" title="{{\App\Providers\MyProvider::_text($product->title)}}" class="img-responsive" /></a></div>
                <div>
                    <div class="caption">
                        <h4><a href="{{ route('web.show.product',$product->id) }}">{{\App\Providers\MyProvider::_text($product->title)}}</a></h4>
                        <p class="description">{{\App\Providers\MyProvider::_text($product->description)}}</p>
                        <p class="price"> <span class="price-new">{{\App\Providers\MyProvider::exToLocalDiscount($product->price,$product->discount)}}{{__('web/public.currency_name_'.session('Local_Currency'))}}</span><br> @if($product->discount>0)<span class="price-old">{{\App\Providers\MyProvider::exToLocal($product->price)}}{{__('web/public.currency_name_'.session('Local_Currency'))}}</span> <span class="saving">-{{$product->discount}}%</span> @endif</p>

                    </div>
                    <div class="button-group">
                        <button class="btn-primary" type="button" onClick=""><span>{{__('web/public.add_cart')}}</span></button>
                        {{--<div class="add-to-links">--}}
                            {{--<button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی ها" onClick=""><i class="fa fa-heart"></i> <span>افزودن به علاقه مندی ها</span></button>--}}
                            {{--<button type="button" data-toggle="tooltip" title="مقایسه این محصول" onClick=""><i class="fa fa-exchange"></i> <span>مقایسه این محصول</span></button>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
    @if(isset($category->children[0]) and $category->children!=[])
        @foreach($category->children as $category)

            <x-web-show-product-in-category :category="$category">
            </x-web-show-product-in-category>
        @endforeach

    @endif


