@foreach($categories as $category)
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
@endforeach

