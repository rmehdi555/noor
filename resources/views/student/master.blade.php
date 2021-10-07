@include('web.section.head')
@include('web.section.header')
    @if($user->status>=5)
        @include('student.section.user-side')
        @yield('content')
        @include('student.section.user-side-end')
    @else
        @yield('content')
    @endif
@include('web.section.footer')
@include('web.section.script')

