<div id="leftsidebar" class="sidebar">
    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: calc(100vh - 65px);">
        <div class="sidebar-scroll" style="overflow: hidden; width: auto; height: calc(100vh - 65px);">
            <nav id="leftsidebar-nav" class="sidebar-nav">
                <ul id="main-menu" class="metismenu">
                    @php
                    if(!isset($SID) or empty($SID))
                        $SID=100;
                    @endphp
                    <li><a href="{{ route('admin.panel',['SID' => '100']) }}"><i
                                    class="icon-home"></i><span>{{__('admin/public.dashboard')}}</span></a></li>
                    {{--<li class="heading">App</li>--}}
                    {{--<li><a href="app-inbox.html"><i class="icon-envelope"></i><span>Inbox</span></a></li>--}}
                    {{--<li><a href="app-chat.html"><i class="icon-bubbles"></i><span>Chat</span></a></li>--}}
                    {{--<li><a href="app-calendar.html"><i class="icon-calendar"></i><span>Calendar</span></a></li>--}}
                    {{--<li><a href="app-taskboard.html"><i class="icon-notebook"></i><span>Taskboard</span></a></li>--}}
                    {{--<li class="heading">UI Elements</li>--}}



                    <li class="@if($SID>=900 and $SID<1000) active @endif">
                        <a href="#site-setting" class="has-arrow"><i
                                    class="icon-diamond"></i><span>{{__('admin/public.site_settings')}}</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li class="@if($SID==900 ) active @endif"><a
                                        href="{{ route('siteDetails.index',['SID' => '900']) }}">{{__('admin/public.site_settings_list')}}</a>
                            </li>
                            <li class="@if($SID==901 ) active @endif"><a
                                        href="{{ route('siteDetails.create',['SID' => '901']) }}">{{__('admin/public.site_settings_add')}}</a>
                            </li>
                            <li class="@if($SID==902 ) active @endif"><a
                                        href="{{ route('contactUs.index',['SID' => '902']) }}">{{__('admin/public.contact_us_list')}}</a>
                            </li>
                            <li class="@if($SID==903 ) active @endif"><a
                                        href="{{ route('complaint.index',['SID' => '903']) }}">{{__('admin/public.complaint_list')}}</a>
                            </li>
                            <li class="@if($SID==904 ) active @endif"><a
                                        href="{{ route('depositsType.index',['SID' => '904']) }}">مدیریت نوع های پرداختی</a>
                            </li>
                            <li class="@if($SID==907 ) active @endif"><a
                                        href="{{ route('deposits.index',['SID' => '907']) }}">مشاهده پرداختی ها</a>
                            </li>
                            <li class="@if($SID==910 ) active @endif"><a
                                        href="{{ route('mosabeghe.index',['SID' => '910']) }}">{{__('admin/public.mosabeghe_maleke_zaman')}}</a>
                            </li>
                            <li class="@if($SID==920 ) active @endif"><a
                                        href="{{ route('webPages.index',['SID' => '920']) }}">{{__('admin/public.web_pages_list')}}</a>
                            </li>
                            <li class="@if($SID==921 ) active @endif"><a
                                        href="{{ route('webPages.create',['SID' => '921']) }}">{{__('admin/public.web_pages_add')}}</a>
                            </li>
                            <li class="@if($SID==930 ) active @endif"><a
                                        href="{{ route('menus.index',['SID' => '930']) }}">{{__('admin/public.menus_list')}}</a>
                            </li>
                            <li class="@if($SID==931 ) active @endif"><a
                                        href="{{ route('menus.create',['SID' => '931']) }}">{{__('admin/public.menus_add')}}</a>
                            </li>
                            <li class="@if($SID==940 ) active @endif"><a
                                        href="{{ route('menuCategories.index',['SID' => '940']) }}">{{__('admin/public.menu_categories_list')}}</a>
                            </li>
                            <li class="@if($SID==941 ) active @endif"><a
                                        href="{{ route('menuCategories.create',['SID' => '941']) }}">{{__('admin/public.menu_categories_add')}}</a>
                            </li>
                            <li class="@if($SID==950 ) active @endif"><a
                                        href="{{ route('noors.index',['SID' => '950']) }}">{{__('admin/public.noors_list')}}</a>
                            </li>
                            <li class="@if($SID==960 ) active @endif"><a
                                        href="{{ route('admin.change.password.index',['SID' => '960']) }}">تغییر رمز عبور</a>
                            </li>
                        </ul>
                    </li>

                    <li class="@if($SID>=400 and $SID<420) active @endif">
                        <a href="#class" class="has-arrow"><i
                                    class="icon-diamond"></i><span>مدیریت کلاس ها و آزمون ها</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li class="@if($SID==400 ) active @endif"><a
                                        href="{{ route('admin.class.list',['SID' => '400']) }}">لیست کلاس ها</a>
                            </li>
                            <li class="@if($SID==401 ) active @endif"><a
                                        href="{{ route('admin.class.create',['SID' => '401']) }}">ایجاد کلاس جدید</a>
                            </li>
                            <li class="@if($SID==410 ) active @endif"><a
                                        href="{{ route('admin.exams.list',['SID' => '410']) }}">مدیریت آزمون ها</a>
                            </li>
                        </ul>
                    </li>


                    <li class="@if($SID>=10 and $SID<30) active @endif">
                        <a href="#news" class="has-arrow"><i
                                    class="icon-diamond"></i><span>{{__('admin/public.news')}}</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li class="@if($SID==10 ) active @endif"><a
                                        href="{{ route('newsCategories.index',['SID' => '10']) }}">{{__('admin/public.news_categories_list')}}</a>
                            </li>
                            <li class="@if($SID==11 ) active @endif"><a
                                        href="{{ route('newsCategories.create',['SID' => '11']) }}">{{__('admin/public.news_categories_add')}}</a>
                            </li>
                            <li class="@if($SID==20 ) active @endif"><a
                                        href="{{ route('news.index',['SID' => '20']) }}">{{__('admin/public.news_list')}}</a>
                            </li>
                            <li class="@if($SID==21 ) active @endif"><a
                                        href="{{ route('news.create',['SID' => '21']) }}">{{__('admin/public.news_add')}}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="@if($SID>=30 and $SID<40) active @endif">
                        <a href="#news" class="has-arrow"><i
                                    class="icon-diamond"></i><span>{{__('admin/public.fields')}}</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li class="@if($SID==30 ) active @endif"><a
                                        href="{{ route('fields.index',['SID' => '30']) }}">{{__('admin/public.fields_list')}}</a>
                            </li>
                            <li class="@if($SID==31 ) active @endif"><a
                                        href="{{ route('fields.create',['SID' => '31']) }}">{{__('admin/public.fields_add')}}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="@if($SID>=40 and $SID<50) active @endif">
                        <a href="#students" class="has-arrow"><i
                                    class="icon-diamond"></i><span>{{__('admin/public.students')}}</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li class="@if($SID==40 ) active @endif"><a
                                        href="{{ route('students.index',['SID' => '40']) }}">{{__('admin/public.students_list')}}</a>
                            </li>
                            <li class="@if($SID==41 ) active @endif"><a
                                        href="{{ route('students.reports',['SID' => '41']) }}">{{__('admin/public.students_reports')}}</a>
                            </li>
                            {{--<li class="@if($SID==41 ) active @endif"><a--}}
                            {{--href="{{ route('students.create',['SID' => '41']) }}">{{__('admin/public.students_add')}}</a>--}}
                            {{--</li>--}}
                        </ul>

                    </li>
                    <li class="@if($SID>=50 and $SID<60) active @endif">
                        <a href="#teachers" class="has-arrow"><i
                                    class="icon-diamond"></i><span>{{__('admin/public.teachers')}}</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li class="@if($SID==50 ) active @endif"><a
                                        href="{{ route('teachers.index',['SID' => '50']) }}">{{__('admin/public.teachers_list')}}</a>
                            </li>
                            <li class="@if($SID==51 ) active @endif"><a
                                        href="{{ route('specialization.index',['SID' => '51']) }}">{{__('admin/public.specialization_index')}}</a>
                            </li>
                            <li class="@if($SID==52 ) active @endif"><a
                                        href="{{ route('specialization.create',['SID' => '52']) }}">{{__('admin/public.specialization_add')}}</a>
                            </li>
                            <li class="@if($SID==53 ) active @endif"><a
                                        href="{{ route('teachers.reports.specialization',['id'=>1,'SID' => '53']) }}">گزارش معلم ها </a>
                            </li>
                            <li class="@if($SID==54 ) active @endif"><a
                                        href="{{ route('admin.work.hours.list.show',['id'=>1,'SID' => '54']) }}">مشاهده لیست پرداختی ها </a>
                            </li>
                            {{--<li class="@if($SID==41 ) active @endif"><a--}}
                            {{--href="{{ route('teachers.create',['SID' => '41']) }}">{{__('admin/public.teachers_add')}}</a>--}}
                            {{--</li>--}}
                        </ul>

                    </li>

                    <li class="@if($SID>=530 and $SID<550) active @endif">
                        <a href="#methodOfLetter" class="has-arrow"><i
                                    class="icon-diamond"></i><span>شیوه نامه ها و جلسات</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li class="@if($SID==530 ) active @endif"><a
                                        href="{{ route('methodOfLetter.index',['SID' => '530']) }}">لیست شیوه نامه ها</a>
                            </li>
                            <li class="@if($SID==531 ) active @endif"><a
                                        href="{{ route('methodOfLetter.create',['SID' => '531']) }}">ایجاد شیوه نامه جدید</a>
                            </li>

                            <li class="@if($SID==540 ) active @endif"><a
                                        href="{{ route('meeting.index',['SID' => '540']) }}">لیست جلسات</a>
                            </li>
                            <li class="@if($SID==541 ) active @endif"><a
                                        href="{{ route('meeting.create',['SID' => '541']) }}">ایجاد جلسه جدید</a>
                            </li>
                        </ul>

                    </li>
                    <li class="@if($SID>=80 and $SID<100) active @endif">
                        <a href="#message" class="has-arrow"><i
                                    class="icon-diamond"></i><span>پیام ها و پشتیبانی ها</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li class="@if($SID==80 ) active @endif"><a
                                        href="{{ route('admin.message.list',['SID' => '80']) }}">لیست پیام ها</a>
                            </li>
                            <li class="@if($SID==81 ) active @endif"><a
                                        href="{{ route('admin.message.add',['SID' => '81']) }}">ارسال پیام جدید</a>
                            <li class="@if($SID==90 ) active @endif"><a
                                        href="{{ route('admin.ticket.list',['SID' => '90']) }}">لیست درخواست های پشتیبانی</a>
                            </li>
                        </ul>

                    </li>
                    <li class="@if($SID>=520 and $SID<530) active @endif">
                        <a href="#practice" class="has-arrow"><i
                                    class="icon-diamond"></i><span>فعالیت ها</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li class="@if($SID==520 ) active @endif"><a
                                        href="{{ route('admin.practice.list',['SID' => '520']) }}">لیست فعالیت های قرآن آموزها</a>
                            </li>
                        </ul>

                    </li>



                    {{--<li class="@if($SID>=500 and $SID<510) active @endif">--}}
                        {{--<a href="#menus" class="has-arrow"><i--}}
                                    {{--class="icon-diamond"></i><span>{{__('admin/public.menus')}}</span></a>--}}
                        {{--<ul aria-expanded="false" class="collapse">--}}
                            {{----}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li class="@if($SID>=60 and $SID<70) active @endif">--}}
                        {{--<a href="#noors" class="has-arrow"><i--}}
                                    {{--class="icon-diamond"></i><span>{{__('admin/public.noors')}}</span></a>--}}
                        {{--<ul aria-expanded="false" class="collapse">--}}
                            {{----}}
                            {{--<li class="@if($SID==41 ) active @endif"><a--}}
                            {{--href="{{ route('teachers.create',['SID' => '41']) }}">{{__('admin/public.teachers_add')}}</a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}

                    {{--</li>--}}




                    <li><a href="{{ route('logout') }}"><i class="icon-logout"></i><span>{{__('admin/public.logout')}}</span></a></li>


                </ul>
            </nav>
        </div>
        <div class="slimScrollBar"
             style="background: rgb(239, 239, 239); width: 2px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 3px; z-index: 99; right: 1px; height: 37.3737px;"></div>
        <div class="slimScrollRail"
             style="width: 2px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
    </div>
</div>