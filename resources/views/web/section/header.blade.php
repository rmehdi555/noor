
<body>
@include('sweet::alert')

<!-- Start: Main Wrapper -->
<div class="bu-wrapper" >

    <div class="bu-overlay"></div>


    <header class="main-header noPrint">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="main-header-cont">
                        <div class="col-md-4">
                            <a href="{{ route('web.home') }}" title="" rel="home" class="main-logo">
                                <h2 style="color: white ; width: auto">{{\App\Providers\MyProvider::_text($siteDetailsProvider["site_name"]->value)}}</h2>
                                {{--<img src="{{$siteDetailsProvider["image_logo"]->images["images"]["original"]}}" alt="" class="">--}}
                            </a>

                        </div>
                        <div class="col-md-4">

                            <div class="s-logo">
                                <img src="{{$siteDetailsProvider["image_header"]->images["images"]["original"]}}" alt="{{\App\Providers\MyProvider::_text($siteDetailsProvider["site_name"]->value)}}">
                            </div>
                        </div>
                        <div class=" col-md-4">
                        <div class="main-header-tc-search">
                            <div class="main-header-tc-topheader">
                                <div class="main-header-tct-item main-date">
                                    <span class="main-header-tcti-date">@php use Hekmatinasser\Verta\Verta;$v=Verta::now();    echo($v->formatWord('l').' '.$v->format('d').' '.$v->formatWord('F').' '.$v->format('Y'));@endphp</span>
                                </div>
                                <div class="main-header-tct-item">
                                    <ul class="main-header-trs-list">
                                        {{--<li><a href="{{\App\Providers\MyProvider::_text($siteDetailsProvider["telegram"]->value)}}"><i class="fab fa-telegram"></i></a></li>--}}
                                        <li><a href="{{\App\Providers\MyProvider::_text($siteDetailsProvider["instagram"]->value)}}"><i class="fab fa-instagram"></i></a></li>
                                    </ul>
                                </div>

                            </div>
                            <form class="main-header-tc-search-form" method="get" >
                                <i class="far fa-search main-header-tc-search-icon" id="main-search-btn"></i>
                                <div class="main-header-tc-search-box" id="main-search-box">
                                    <div class="main-header-tc-search-close" id="main-search-close"><i class="fal fa-times"></i></div>
                                    <input class="form-control main-header-tc-search-input main-search-placeholder" name="s" placeholder="جستجو کنید..." id="main-search-input" autocomplete="off">
                                    <button type="submit" class="main-header-tc-search-btn"><i class="far fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="main-header-nav-cont noPrint">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-menu navbar-offcanvas navbar-offcanvas-touch" id="js-bootstrap-offcanvas">
                        <ul class="main-menu-list">
                            @foreach($webMenusHeaderProvider as $menu)
                                @if($menu->parent_id==0 AND isset($menu->children[0]) AND $menu->children!=[])
                                    <li class=""><a href="{{ $menu->link }}" id="dropdownMenuButton" data-toggle="dropdown">{{\App\Providers\MyProvider::_text($menu->title)}} <i class="fa fa-caret-down main-menu-arrow"></i></a>
                                        @if(isset($menu->children[0]) and $menu->children!=[])
                                            <ul class="main-menu-dropmenu dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                <x-web-show-menus :menus="$menu->children">
                                                </x-web-show-menus>
                                            </ul>
                                        @endif
                                    </li>
                                @elseif($menu->parent_id==0)
                                    <li class=""><a href="{{ $menu->link }}">{{\App\Providers\MyProvider::_text($menu->title)}}</a></li>
                                @endif
                            @endforeach

                                @if(auth()->check())
                                    <li class=""><a href="{{ route('logout') }}">{{__('web/public.btn_logout')}}</a></li>
                                @else
                                    <li class=""><a href="{{ route('login') }}">{{__('web/public.btn_login')}}</a></li>
                                @endif
                        </ul>
                    </div>
                    <button class="navbar-toggler offcanvas-toggle" type="button" data-toggle="offcanvas" data-target="#js-bootstrap-offcanvas" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                        <a class="menu-btn menu-link" id="nav-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>
                    </button>
                </div>
            </div>
        </div>
    </div>



