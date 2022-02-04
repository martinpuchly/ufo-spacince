@auth



<ul>MENU:
    @if(auth()->user()->has_admin_link)

    <li><a href="{{route('admin')}}">administrácia</a>
        @endif

    </li>
</ul>

@endauth