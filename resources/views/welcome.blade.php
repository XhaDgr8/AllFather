



<!DOCTYPE html>
<html>

<head>
    <!-- Meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Chrome, Firefox OS and Opera mobile address bar theming -->
    <meta name="theme-color" content="#000000">
    <!-- Windows Phone mobile address bar theming -->
    <meta name="msapplication-navbutton-color" content="#000000">
    <!-- iOS Safari mobile address bar theming -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#000000">

    <!-- SEO -->
    <meta name="description" content="Halfmoon is a responsive front-end framework, designed for quickly building beautiful dashboards and product pages. Built-in dark mode, optional JavaScript library (no jQuery), Bootstrap like classes, and cross-browser compatibility (including IE11).">
    <meta name="author" content="Halfmoon">
    <meta name="keywords" content="Halfmoon, HTML, CSS, JavaScript, CSS Framework, dark mode, dark-mode, darkmode, dark theme, dark-theme, darktheme, Bootstrap, Foundation, Bulma, dashboard, UI, UI framework, user interface, design, design system">

    <!-- Open graph -->
    <meta property="fb:app_id" content="2560228000973437">
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://www.gethalfmoon.com">
    <meta property="og:title" content="Halfmoon - Front-end framework with a built-in dark mode, designed for rapidly building beautiful dashboards and product pages">
    <meta property="og:description" content="Halfmoon is a responsive front-end framework, designed for quickly building beautiful dashboards and product pages. Built-in dark mode, optional JavaScript library (no jQuery), Bootstrap like classes, and cross-browser compatibility (including IE11).">
    <meta property="og:image" content="https://res.cloudinary.com/halfmoon-ui/image/upload/v1593528979/halfmoon-og-image_zl1bob.png">

    <!-- Fav and Title -->
    <link rel="icon" href="/static/halfmoon/img/halfmoon-icon.png">
    <title>Page sections demo - Halfmoon</title>

    <!-- Halfmoon -->
    <link href="https://cdn.jsdelivr.net/gh/halfmoonui/halfmoon@1.0.3/css/halfmoon.min.css" rel="stylesheet" />
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
    <!-- Roboto font (Used when Apple system fonts are not available) -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Documentation styles -->
    <link href="/static/site/css/documentation-styles-2.css" rel="stylesheet">
</head>

<body class=" with-custom-webkit-scrollbars with-custom-css-scrollbars">

<!-- Page wrapper start -->
<div id="page-wrapper" class="page-wrapper with-navbar with-sidebar with-navbar-fixed-bottom" data-sidebar-type="overlayed-sm-and-down">

    <!-- Sticky alerts -->
    <div class="sticky-alerts"></div>

    <!-- Navbar start -->
    <nav class="navbar">
        <div class="navbar-content">
            <button id="toggle-sidebar-btn" class="btn btn-action" type="button" onclick="halfmoon.toggleSidebar()">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </button>
        </div>
        <a href="#" class="navbar-brand ml-10 ml-sm-20">
            <img src="{{asset('storage/sa/logo/logo_lg.png')}}" alt="fake-logo">
        </a>
        <div class="navbar-content ml-auto">
            @if (Route::has('login'))
                <div class="top-right links">
                    <!-- Toggling dark mode -->
                    <button class="btn btn-primary" type="button" onclick="halfmoon.toggleDarkMode()">Click me!</button>
                    @auth
                        <a class="btn btn-primary" role="button" href="{{ url('/home') }}">Home</a>
                    @else
                        <a class="btn btn-primary" role="button" href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a class="btn btn-outline-success" role="button" href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </nav>
    <!-- Navbar end -->

    <!-- Sidebar overlay -->
    <div class="sidebar-overlay" onclick="halfmoon.toggleSidebar()"></div>

    <!-- Sidebar start -->
    <div class="sidebar">
        <div class="sidebar-menu">
            <div class="sidebar-content">
                <input type="text" class="form-control" placeholder="Search">
                <div class="mt-10 font-size-12">
                    Press <kbd>/</kbd> to focus
                </div>
            </div>
            <h5 class="sidebar-title">Getting started</h5>
            <div class="sidebar-divider"></div>
            <a href="#" class="sidebar-link sidebar-link-with-icon active">
                    <span class="sidebar-icon">
                        <i class="fa fa-code" aria-hidden="true"></i>
                    </span>
                Installation
            </a>
            <a href="#" class="sidebar-link sidebar-link-with-icon">
                    <span class="sidebar-icon">
                        <i class="fa fa-terminal" aria-hidden="true"></i>
                    </span>
                CLI commands
            </a>
            <br />
            <h5 class="sidebar-title">Components</h5>
            <div class="sidebar-divider"></div>
            <a href="#" class="sidebar-link sidebar-link-with-icon">
                    <span class="sidebar-icon">
                        <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                    </span>
                File explorer
            </a>
            <a href="#" class="sidebar-link sidebar-link-with-icon">
                    <span class="sidebar-icon">
                        <i class="fa fa-table" aria-hidden="true"></i>
                    </span>
                Spreadsheet
            </a>
            <a href="#" class="sidebar-link sidebar-link-with-icon">
                    <span class="sidebar-icon">
                        <i class="fa fa-map-o" aria-hidden="true"></i>
                    </span>
                Map
            </a>
            <a href="#" class="sidebar-link sidebar-link-with-icon">
                    <span class="sidebar-icon">
                        <i class="fa fa-commenting-o" aria-hidden="true"></i>
                    </span>
                Messenger
            </a>
        </div>
    </div>
    <!-- Sidebar end -->

    <!-- Content wrapper start -->
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row row-eq-spacing-lg">
                <div class="col-lg-9">
                    <div class="content">
                        <h1 class="content-title">
                            Page title
                        </h1>
                        <div class="fake-content"></div>
                        <div class="fake-content"></div>
                    </div>
                    <div class="card">
                        <h2 class="card-title">
                            Card title
                        </h2>
                        <div class="fake-content"></div>
                        <div class="fake-content"></div>
                        <div class="fake-content"></div>

                        <button class="btn btn-primary btn-sm" type="button" onclick="toastAlert()">Toast!</button>

                    </div>
                    <div class="content">
                        <div class="fake-content"></div>
                        <div class="fake-content w-150"></div>
                    </div>
                </div>
                <div class="col-lg-3 d-none d-lg-block">
                    <div class="content">
                        <h2 class="content-title font-size-20">
                            On this page
                        </h2>
                        <div class="fake-content"></div>
                        <div class="fake-content"></div>
                        <div class="fake-content"></div>
                        <div class="fake-content"></div>
                        <div class="fake-content"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content wrapper end -->

    <!-- Navbar fixed bottom start -->
    <nav class="navbar navbar-fixed-bottom">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fa fa-question-circle-o mr-5" aria-hidden="true"></i>
                    Help
                </a>
            </li>
        </ul>
        <span class="navbar-text">
                &copy; Copyright 2020, Brand
            </span>
    </nav>
    <!-- Navbar fixed bottom end -->

</div>
<!-- Page wrapper end -->

<!-- Halfmoon JS -->
<script src="https://cdn.jsdelivr.net/gh/halfmoonui/halfmoon@1.0.3/js/halfmoon.min.js"></script>
<script type="text/javascript">
    // Toasts a default alert
    function toastAlert() {
        var alertContent = "This is a default alert with <a href='#' class='alert-link'>a link</a> being toasted.";
        // Built-in function
        halfmoon.initStickyAlert({
            content: alertContent,
            title: "Toast!"
        })
    }
</script>
</body>

</html>
