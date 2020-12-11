<!-- Feature Box End-->
<div id="container">
    <!-- Feature Box Start-->
    <div class="container">
        <div class="custom-feature-box row">

        </div>
    </div>
    <!-- Feature Box End-->
<div class="container">
    <div class="row">
        <!-- Left Part Start-->
        <aside id="column-left" class="col-sm-3 hidden-xs">
            <h3 class="subtitle"> {{__('user/public.panel')}}</h3>
            <div class="box-category">
                <ul id="cat_accordion">
                    <li>
                        <a href="{{ route('user.panel') }}">{{__('user/public.panel')}} {{auth()->user()->name}} {{auth()->user()->family}} </a>
                        <a href="{{ route('logout') }}">{{__('user/public.btn_logout')}}</a>
                    </li>
                </ul>


        </aside>
