
    @foreach($menus as $menu)
        <li><a href="{{ $menu->link }}">{{\App\Providers\MyProvider::_text($menu->title)}}</a></li>
    @endforeach


