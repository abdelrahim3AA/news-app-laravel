
<!--
 * CoreUI - Open Source Bootstrap Admin Template
 * @version v1.0.0-alpha.2
 * @link http://coreui.io
 * Copyright (c) 2016 creativeLabs Łukasz Holeczek
 * @license MIT
 -->
 <!DOCTYPE html>
<html lang="IR-fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI Bootstrap 4 Admin Template">
    <meta name="author" content="Lukasz Holeczek">
    <meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">
    <title> @yield('title') </title>
    <!-- Icons -->
    <link href="{{asset('adminassets/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('adminassets/css/simple-line-icons.css')}}" rel="stylesheet">
    
    <!-- Main styles for this application -->
    <link href="{{asset('adminassets/dest/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.css" />
</head>
<body class="navbar-fixed sidebar-nav fixed-nav">
<header class="navbar">
        <div class="container-fluid">
            <button class="navbar-toggler mobile-toggler hidden-lg-up" type="button">&#9776;</button>
            <a class="navbar-brand" href="#"></a>
            <ul class="nav navbar-nav hidden-md-down">
                <li class="nav-item">
                    <a class="nav-link navbar-toggler layout-toggler" href="#">&#9776;</a>
                </li>

                <li class="nav-item p-x-1">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn btn-outline-danger" onclick="if(!confirm('Do You Want To Logout!')) return false;"><i class="fa fa-lock"></i> {{ __('words.logout') }}</button>
                    </form>
                </li>
            </ul>
            <ul class="nav navbar-nav pull-left hidden-md-down">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src={{asset(str_replace(' ', '%20', Auth::user()->image))}} class="img-avatar" alt={{ Auth::user()->name }}>
                        <span class="hidden-md-down">{{ Auth::user()->name . " [ " . Auth::user()->status  . " ] "}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                       
                        <a class="dropdown-item" href="{{ route('dashboard.users.edit', Auth::user()->id) }}"><i class="fa fa-user"></i> {{ __('words.profile') }}</a>
                        @can('viewAny', $settings)
                        <a class="dropdown-item" href="{{ route('dashboard.settings') }}"><i class="fa fa-wrench"></i> {{__('words.settings')}}</a>
                        @endcan
                        <!--<a class="dropdown-item" href="#"><i class="fa fa-usd"></i> Payments<span class="tag tag-default">42</span></a>-->
                        <div class="divider"></div>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="dropdown-item"><i class="fa fa-lock"></i>{{ __('words.logout') }}</button>
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link navbar-toggler aside-toggle" href="#">&#9776;</a>
                </li>
            </ul>

            <ul class="nav navbar-nav pull-left hidden-md-down">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="hidden-md-down">{{ LaravelLocalization::getCurrentLocaleNative() }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a rel="alternate" class="dropdown-item" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                        @endforeach
                        <div class="divider"></div>
                    </div>
                </li>
            </ul>
        </div>
</header>

