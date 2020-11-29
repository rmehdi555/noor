
    @foreach($categories as $category)
    <li><a href="{{ route('web.show.category',$category->id) }}">{{\App\Providers\MyProvider::_text($category->title)}}
        @if(isset($category->children[0]) and $category->children!=[])<span>&rsaquo;</span></a>

            <div class="dropdown-menu">
                <ul>
                    <x-web-show-categories :categories="$category->children">
                    </x-web-show-categories>
                </ul>
            </div>
        @else
        </a>
        @endif
    </li>
    @endforeach


