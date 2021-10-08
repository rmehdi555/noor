@include('web.section.head')
@include('web.section.header')
@if($user->status>=4)
    @include('teacher.section.user-side')
    @yield('content')
    @include('teacher.section.user-side-end')
@else
    @yield('content')
@endif
@include('web.section.footer')
@include('web.section.script')

