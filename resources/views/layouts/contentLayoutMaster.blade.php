@yield('page-vars')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$title}} - {{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js">
    </script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script type="text/javascript">
        /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
        particlesJS.load('particles-js', '/js/particles.json');
    </script>
    @yield('scripts')
</head>
<body id="test" class="bg-light">
    <div id="app" class="position-relative">
    <div style="z-index: 300" class="modal-vue h-100 w-100 d-none p-5 position-absolute">
        <file-system :id="{{auth()->user()->id}}" asset="{{asset('storage/users/'.auth()->user()->id.'/')}}" />
    </div>
    <div class="layout row g-0">
        <div id="sidebar" class="anime shadow-md position-relative p-0 col-auto bg-white overflow-hidden">
            <x-sidebar :subActive="$subActive" :active="$active"></x-sidebar>
        </div>
        <div id="content" class="col position-relative anime">
            <x-navbar></x-navbar>
            <main class="p-4" style="min-height: 85vh">
                @if(isset($bread))
                    <div class="row g-0">
                        <div class="col-auto">
                            <h3 class="font-monospace">{{$title}}<div class="d-inline border border-dark ml-2"></div></h3>

                        </div>
                        <div class="col">
                            <nav class="bg-transparent float-left" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                                    @foreach($bread as $key => $crum)
                                        <li class="breadcrumb-item {{$key}}" aria-current="page">{{$crum}}</li>
                                    @endforeach
                                </ol>
                            </nav>
                        </div>
                    </div>
                @endif
                @yield('content')
            </main>
            <x-footer></x-footer>
        </div>
    </div>
</div>
</body>
</html>
