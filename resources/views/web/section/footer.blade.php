
<!-- Start: Footer -->
<footer class="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="main-footer-cont">
                    <div class="main-footer-links"">
                        <div class="bu-title white bu-margin-bottom-20">
                            <div class="bu-title-cont">
                                <h3 class="bu-title-name">{!! \App\Providers\MyProvider::_text($siteDetailsProvider["footer_about_title"]->value) !!}</h3>
                            </div>
                        </div>
                    <ul class="main-footer-contact-list">
                        <li>
                        {!! \App\Providers\MyProvider::_text($siteDetailsProvider["footer_about_body"]->value) !!}
                        </li>
                    </ul>
                    </div>
                    <div class="main-footer-links">
                        <div class="bu-title white bu-margin-bottom-20">
                            <div class="bu-title-cont">
                                <h3 class="bu-title-name">پیوند ها</h3>
                            </div>
                        </div>
                        <ul class="main-footer-links-list">
                            @foreach($webMenusFooter1Provider as $item)
                                <li><a href="{{$item->link}}" target="_blank">{{\App\Providers\MyProvider::_text($item->title)}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="main-footer-contact">
                        <div class="bu-title white bu-margin-bottom-20">
                            <div class="bu-title-cont">
                                <h3 class="bu-title-name">ارتباط با ما</h3>
                            </div>
                        </div>
                        <ul class="main-footer-contact-list">
                            <li>
                                <i class="fal fa-location-arrow"></i>
                                {{\App\Providers\MyProvider::_text($siteDetailsProvider["address"]->value)}}
                            </li>
                            <li>
                                <i class="fal fa-envelope"></i>
                                {{\App\Providers\MyProvider::_text($siteDetailsProvider["email"]->value)}}
                            </li>
                            <li>
                                <i class="fal fa-phone"></i>
                                {!! \App\Providers\MyProvider::_text($siteDetailsProvider["phone"]->value) !!}
                            </li>
                            <li>
                                <i class="fal fa-phone"></i>
                                {!! \App\Providers\MyProvider::_text($siteDetailsProvider["mobile"]->value) !!}
                            </li>
                        </ul>
                        <ul class="main-header-trs-list">
                            {{--<li><a href=""><i class="fab fa-telegram"></i></a></li>--}}
                            <li><a href="{{\App\Providers\MyProvider::_text($siteDetailsProvider["instagram"]->value)}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            {{--<li><a href=""><img src="assets/img/theme/aparat-logo-white.svg"></a></li>--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End: Footer -->

<!-- Start: Copyright -->
<section class="main-copyright">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="main-copyright-cont">
                    <div class="main-copyright-right">
                        <ul class="main-copyright-menu">
                            @foreach($webMenusHeaderProvider as $menu)
                                @if($menu->parent_id==0)
                                    <li ><a href="{{ $menu->link }}">{{\App\Providers\MyProvider::_text($menu->title)}}</a></li>
                                @endif
                            @endforeach

                        </ul>
                        <small class="main-copyright-text"> تمامی حقوق این وب سایت متعلق به قرآنکده نور موعود (عج) می باشد</small>
                    </div>
                    <div class="main-copyright-left">
                        <ul class="main-copyright-b-list">
                            {{--<li>--}}
                                {{--<img src="assets/img/dummy/badge-1.png">--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<img src="assets/img/dummy/badge-2.png">--}}
                            {{--</li>--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End: Copyright -->

</div>
