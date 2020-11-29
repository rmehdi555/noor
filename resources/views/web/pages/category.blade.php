@extends('web.master-product')
@section('content')

    <!--Middle Part Start-->
    <div id="content" class="col-sm-9">
        <h1 class="title">{{\App\Providers\MyProvider::_text($category->title)}}</h1>

        <div class="product-filter">
            <div class="row">
                <div class="col-md-4 col-sm-5">
                    <div class="btn-group">
                        <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="List"><i class="fa fa-th-list"></i></button>
                        <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="Grid"><i class="fa fa-th"></i></button>
                    </div>
                    {{--<a href="compare.html" id="compare-total">محصولات مقایسه (0)</a> --}}
                </div>
                {{--<div class="col-sm-2 text-right">--}}
                    {{--<label class="control-label" for="input-sort">مرتب سازی :</label>--}}
                {{--</div>--}}
                {{--<div class="col-md-3 col-sm-2 text-right">--}}
                    {{--<select id="input-sort" class="form-control col-sm-3">--}}
                        {{--<option value="" selected="selected">پیشفرض</option>--}}
                        {{--<option value="">نام (الف - ی)</option>--}}
                        {{--<option value="">نام (ی - الف)</option>--}}
                        {{--<option value="">قیمت (کم به زیاد)</option></option>--}}
                        {{--<option value="">قیمت (زیاد به کم)</option>--}}
                        {{--<option value="">امتیاز (بیشترین)</option>--}}
                        {{--<option value="">امتیاز (کمترین)</option>--}}
                        {{--<option value="">مدل (A - Z)</option>--}}
                        {{--<option value="">مدل (Z - A)</option>--}}
                    {{--</select>--}}
                {{--</div>--}}
                {{--<div class="col-sm-1 text-right">--}}
                    {{--<label class="control-label" for="input-limit">نمایش :</label>--}}
                {{--</div>--}}
                {{--<div class="col-sm-2 text-right">--}}
                    {{--<select id="input-limit" class="form-control">--}}
                        {{--<option value="" selected="selected">20</option>--}}
                        {{--<option value="">25</option>--}}
                        {{--<option value="">50</option>--}}
                        {{--<option value="">75</option>--}}
                        {{--<option value="">100</option>--}}
                    {{--</select>--}}
                {{--</div>--}}
            </div>
        </div>
        <br />

        <div class="row products-category">
            <x-web-show-product-in-category :category="$category">
            </x-web-show-product-in-category>
        </div>




        <div class="row">
            <div class="col-sm-6 text-left">
                <ul class="pagination">
                    <li class="active"><span>1</span></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">&gt;</a></li>
                    <li><a href="#">&gt;|</a></li>
                </ul>
            </div>
            <div class="col-sm-6 text-right">نمایش 1 تا 12 از 15 (مجموع 2 صفحه)</div>
        </div>
    </div>
    <!--Middle Part End -->
    </div>
    </div>
    </div>
@endsection