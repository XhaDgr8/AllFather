<div class="my-2">
    @if(count($subs) > 0)
        <button
            class="btn text-muted btn-block hovered {{$menu['active'] == $menu['id'] ? 'btn-outline-primary shadow-md-primary ' : "" }}"
            type="button" data-toggle="collapse"
            data-target="#{{ $menu['id']}}" aria-expanded="false"
            aria-controls="{{ $menu['id']}}">
            <p class="m-0 text-left">
                <x-icon i="{{$menu['icon']}}" class="mr-3" h="1rem" w="1rem"/>
                <span class="sp-lg">{{ $menu['name']}}</span>
            </p>
        </button>


        <div id="{{ $menu['id'] }}" class="collapse {{$menu['active'] == $menu['id'] ? 'show' : "" }}"
             aria-labelledby="{{ $menu['id']}}" data-parent="#accord">
            <div class="card-body p-0 py-1">
                @foreach($subs as $sub)
                    <a id="{{$sub['id']}}" href="{{$sub['url']}}"
                       class="btn btn-block btn-link text-decoration-none text-left hovered {{$sub['active'] == $sub['id'] ? 'btn-primary shadow-md-primary ' : "" }}">
                        <x-icon i="circle" class="mr-2" h=".5rem" w=".5rem"/>
                        <span class="sp-lg">{{ $sub['name'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    @else
        <a href="{{$menu['url'] }}" id="{{$menu['id']}}"
           class="btn btn-link text-muted btn-block text-decoration-none hovered {{$menu['active'] == $menu['id'] ? 'btn-primary shadow-md-primary ' : "" }}">
            <p class="m-0 text-left {{$menu['active'] == $menu['id'] ? 'text-white' : "" }}">
                <x-icon i="{{$menu['icon'] }}" class="mr-3" h="1rem" w="1rem"/>
                <span class="sp-lg">{{ $menu['name'] }}</span>
            </p>
        </a>
    @endif
</div>
