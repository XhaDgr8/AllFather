<div id="theside" class="p-0 position-fixed"
     style="z-index: 22;width:inherit;max-width:inherit;overflow-x: hidden">
    <nav class="g-0 py-2 row" style="min-width: 13rem">
        <div class="col-10 p-0">
            <a class="navbar-brand nav-link" href="{{ url('/') }}">
                <img src="{{asset('storage/sa/logo/logo_sm.png')}}" alt="" style="max-height: 2rem"
                     class="img-fluid d-md-none d-block logo-sm ml-1">
                <img src="{{asset('storage/sa/logo/logo_lg.png')}}" alt="" class="img-fluid d-md-block d-none logo-lg">
            </a>
        </div>
        <div id="toggle-sidebar" class="col-2 pointer open p-0 d-flex flex-column justify-content-center">
            <x-icon i="dotCircle" class="text-primary" h="1rem" w="1rem"/>
        </div>
    </nav>
    <div class="mt-2">
        <div class="accordion" id="accord">
            <div class="container">
                @if (auth()->user()->roles()->where('name', 'admin')->exists())
                    @foreach($navLinks as $link)
                        @if(array_key_exists('subMenu', $link))
                            <div class="my-2">
                                <button class="btn text-muted btn-block
                        hovered {{$active == $link['slug'] ? 'btn-primary shadow-md-primary ' : "" }}"
                                        type="button" data-toggle="collapse"
                                        data-target="#{{ $link['slug'] }}" aria-expanded="false"
                                        aria-controls="{{ $link['slug'] }}">
                                    <p class="m-0 text-left {{$active == $link['slug'] ? 'text-white' : "" }}">
                                        <x-icon i="{{$link['icon']}}" class="mr-3" h="1rem" w="1rem"/>
                                        <span class="sp-lg">{{ $link['name'] }}</span>
                                    </p>
                                </button>


                                <div id="{{ $link['slug'] }}" class="collapse"
                                     aria-labelledby="{{ $link['name'] }}" data-parent="#accord">
                                    <div class="card-body p-0 py-1">
                                        @foreach($link['subMenu'] as $sublink)
                                            <button class="btn btn-block btn-link text-decoration-none text-left hovered">
                                                <x-icon i="circle" class="mr-2" h=".5rem" w=".5rem"/>
                                                <span class="sp-lg">{{ $sublink['name'] }}</span>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                            <a aria-expanded="true" href="{{$link['url']}}"
                               class="btn btn-block btn-link text-dark text-decoration-none text-left
                       hovered {{ $active == $link['slug'] ? 'btn-primary shadow-md-primary text-white' : "" }}">
                                <x-icon i="{{$link['icon']}}" class="mr-3" h="1rem" w="1rem"/>
                                <span class="sp-lg">{{ $link['name'] }}</span>
                            </a>
                        @endif
                    @endforeach
                @else
                    @foreach($navLinks as $link)
                        @can('page_worker')
                            @if(in_array('page_worker', $link['for']))
                                @if(array_key_exists('subMenu', $link))
                                    <div class="my-2">
                                        <button class="btn text-muted btn-block
                    hovered {{$active == $link['slug'] ? 'btn-primary shadow-md-primary ' : "" }}"
                                                type="button" data-toggle="collapse"
                                                data-target="#{{ $link['slug'] }}" aria-expanded="false"
                                                aria-controls="{{ $link['slug'] }}">
                                            <p class="m-0 text-left {{$active == $link['slug'] ? 'text-white' : "" }}">
                                                <x-icon i="{{$link['icon']}}" class="mr-3" h="1rem" w="1rem"/>
                                                <span class="sp-lg">{{ $link['name'] }}</span>
                                            </p>
                                        </button>


                                        <div id="{{ $link['slug'] }}" class="collapse"
                                             aria-labelledby="{{ $link['name'] }}" data-parent="#accord">
                                            <div class="card-body p-0 py-1">
                                                @foreach($link['subMenu'] as $sublink)
                                                    <button class="btn btn-block btn-link text-decoration-none text-left hovered">
                                                        <x-icon i="circle" class="mr-2" h=".5rem" w=".5rem"/>
                                                        <span class="sp-lg">{{ $sublink['name'] }}</span>
                                                    </button>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <a aria-expanded="true" href="{{$link['url']}}"
                                       class="btn btn-block btn-link text-dark text-decoration-none text-left
                   hovered {{ $active == $link['slug'] ? 'btn-primary shadow-md-primary text-white' : "" }}">
                                        <x-icon i="{{$link['icon']}}" class="mr-3" h="1rem" w="1rem"/>
                                        <span class="sp-lg">{{ $link['name'] }}</span>
                                    </a>
                                @endif
                            @endif
                        @endcan

                        @can('page_customer')
                            @if(in_array('page_customer', $link['for']))
                                @if(array_key_exists('subMenu', $link))
                                    <div class="my-2">
                                        <button class="btn text-muted btn-block
                hovered {{$active == $link['slug'] ? 'btn-primary shadow-md-primary ' : "" }}"
                                                type="button" data-toggle="collapse"
                                                data-target="#{{ $link['slug'] }}" aria-expanded="false"
                                                aria-controls="{{ $link['slug'] }}">
                                            <p class="m-0 text-left {{$active == $link['slug'] ? 'text-white' : "" }}">
                                                <x-icon i="{{$link['icon']}}" class="mr-3" h="1rem" w="1rem"/>
                                                <span class="sp-lg">{{ $link['name'] }}</span>
                                            </p>
                                        </button>


                                        <div id="{{ $link['slug'] }}" class="collapse"
                                             aria-labelledby="{{ $link['name'] }}" data-parent="#accord">
                                            <div class="card-body p-0 py-1">
                                                @foreach($link['subMenu'] as $sublink)
                                                    <button class="btn btn-block btn-link text-decoration-none text-left hovered">
                                                        <x-icon i="circle" class="mr-2" h=".5rem" w=".5rem"/>
                                                        <span class="sp-lg">{{ $sublink['name'] }}</span>
                                                    </button>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <a aria-expanded="true" href="{{$link['url']}}"
                                       class="btn btn-block btn-link text-dark text-decoration-none text-left
               hovered {{ $active == $link['slug'] ? 'btn-primary shadow-md-primary text-white' : "" }}">
                                        <x-icon i="{{$link['icon']}}" class="mr-3" h="1rem" w="1rem"/>
                                        <span class="sp-lg">{{ $link['name'] }}</span>
                                    </a>
                                @endif
                            @endif
                        @endcan
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

