<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title') - NEWSY</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{ asset('front/my_img/logo2.jpg') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('front')}}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('front')}}/css/style.css" rel="stylesheet">

    <style>
        body {
    font-family: 'Roboto', sans-serif;
    color: #e0e0e0;
    background-color: #1a1a1a;
}

.bg-dark-red {
    background-color: #ED1C24;
}

.text-light {
    color: #fff;
}

.btn-primary {
    background-color: #ED1C24;
    border-color: #ED1C24;
}

.btn-primary:hover {
    background-color: #c0392b;
    border-color: #c0392b;
}

.navbar-light .navbar-nav .nav-link {
    color: #e0e0e0;
}

.navbar-light .navbar-nav .nav-link:hover {
    color: #ED1C24;
}

.footer {
    background-color: #333;
    color: #e0e0e0;
}

.footer a {
    color: #ED1C24;
}

.footer a:hover {
    color: #c0392b;
}

.overlay {
    background: rgba(0, 0, 0, 0.6);
    color: #e0e0e0;
}

.card-category {
    border-radius: 12px;
    overflow: hidden;
    background-color: #333;
    color: #e0e0e0;
}

.trending-item {
    background: #ED1C24;
    color: #fff;
    padding: 10px;
    border-radius: 10px;
    font-size: 16px;
    font-weight: bold;
}

.trending-item:hover {
    background: #c0392b;
}

.trending-item-small {
    background: #d32f2f;
    color: #fff;
    padding: 10px;
    border-radius: 10px;
    font-size: 14px;
    margin-bottom: 5px;
}

.trending-item-small:hover {
    background: #c62828;
}

.newsletter {
    background-color: #2a2a2a;
    padding: 20px;
    border-radius: 10px;
}

.newsletter input {
    border-radius: 5px 0 0 5px;
}

.newsletter button {
    border-radius: 0 5px 5px 0;
}

.logo-shadow {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    text-shadow: 0 0 10px rgba(255, 255, 255, 0.7);
}

.text-red {
    color: #ED1C24;
}

.text-white {
    color: #FFFFFF;
}

.navbar-lang-icon {
    margin-left: 10px;
    font-size: 20px;
    color: #e0e0e0;
    cursor: pointer;
}

.navbar-lang-icon:hover {
    color: #ED1C24;
}

/* Language Dropdown Menu */
.language-dropdown {
    position: absolute;
    right: 0;
    top: 100%;
    display: none;
    background-color: #333;
    color: #fff;
    padding: 10px;
    border-radius: 5px;
    list-style: none;
    text-align: left;
    width: 150px;
}

.language-dropdown.show {
    display: block;
}

.language-dropdown .dropdown-item {
    color: #fff;
    text-decoration: none;
    font-size: 16px;
    display: block;
    padding: 5px 10px;
}

.language-dropdown .dropdown-item:hover {
    background-color: #ED1C24;
    color: #fff;
}

    </style>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid px-lg-5">
        <div class="row align-items-center bg-dark-red text-light px-lg-5 py-2">
            <div class="col-12 col-md-8">
                <div class="d-flex justify-content-between">
                    <div class="trending-item text-center py-2" style="width: 100px;">TRENDING</div>
                    <div class="owl-carousel owl-carousel-1 tranding-carousel position-relative d-inline-flex align-items-center ml-3" style="width: calc(100% - 100px); padding-left: 90px;">
                        @foreach ($lastFivePosts as $post)
                        <div class="trending-item-small text-truncate">
                            <a class="text-light" href="{{ route('website.posts.show', $post->id) }}">{{ $post->title }}</a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-right d-none d-md-block text-light">
                {{ date('l, F d, Y') }}
            </div>
        </div>
        <div class="row align-items-center py-2 px-lg-5">
            <div class="col-lg-4">
                <a href="{{ route('website.index') }}" class="navbar-brand text-light">
                    <img src="{{ asset('front/my_img/logo.png') }}" alt="" width="100px" height="70px" class="logo-shadow">
                    <span class="text-red">NEWS</span><span class="text-white">SY</span>
                </a>
            </div>
            <div class="col-lg-8 text-center text-lg-right">
                <img class="img-fluid" src="img/ads-700x70.jpg" alt="">
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid p-0 mb-3">
        <nav class="navbar navbar-expand-lg navbar-light py-2 py-lg-0 px-lg-5 bg-dark">
            <a href="{{ route('website.index') }}" class="navbar-brand d-block d-lg-none text-light">
                <h1 class="mb-2 mt-n2 display-5 text-uppercase">
                    <span class="text-red">NEWS</span><span class="text-white">SY</span>
                </h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">
                    <a href="{{ route('website.index') }}" class="nav-item nav-link active text-light">{{ __('words.home') }}</a>
                    @foreach ($categories as $category)
                    @if($category->children->isNotEmpty())
                    <div class="nav-item dropdown">
                        <a href="{{ route('website.categories.show', $category->id) }}" class="nav-link dropdown-toggle text-light" data-toggle="dropdown">{{ $category->title }}</a>
                        <div class="dropdown-menu rounded-0 m-0 bg-dark">
                            @foreach ($category->children as $child)
                            <a href="{{ route('website.categories.show', $child->id) }}" class="dropdown-item text-light">{{$child->title}}</a>
                            @endforeach
                        </div>
                    </div>
                    @elseif ($category->parent == null)
                    <a href="{{ route('website.categories.show', $category->id) }}" class="nav-item nav-link text-light">{{ $category->title }}</a>
                    @endif
                    @endforeach
                    <a href="{{ route('website.categories.index') }}" class="nav-item nav-link text-light">{{ __('words.All Categories') }}</a>
                </div>
                <div class="d-flex align-items-center">
                    <div class="input-group ml-auto" style="width: 100%; max-width: 300px;">
                        <input type="text" class="form-control" placeholder="Keyword">
                        <div class="input-group-append">
                            <button class="input-group-text text-dark bg-red"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    
                    <!-- Language Icon -->
                    <i class="fas fa-globe navbar-lang-icon" id="languageIcon" aria-haspopup="true" aria-expanded="false"></i>
                    <ul class="language-dropdown" id="languageDropdown">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li><a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    @yield('content')

    <!-- Footer Start -->
<div class="container-fluid footer pt-5 px-sm-3 px-md-5 bg-dark text-light">
    <div class="row">
        <!-- Site Name Section -->
        <div class="col-lg-4 col-md-6 mb-5">
            <p>{{ __('words.desc_footer') }}</p>
            <a href="{{ route('website.index') }}" class="navbar-brand text-light">
                <h1 class="mb-2 mt-n2 display-5 text-uppercase">
                    <span class="text-red">NEWS</span><span class="text-white">SY</span>
                </h1>
            </a>
            <div>
                <img src="{{ asset('front/my_img/logo.png') }}" alt="" width="200px" height="150px">

            </div>
        </div>

        <!-- Categories Section -->
        <div class="col-lg-4 col-md-6 mb-5">
            <h4 class="font-weight-bold mb-4">{{ __('words.categories') }}</h4>
            <div class="d-flex flex-wrap">
                @foreach ($categories as $category)
                    <a href="{{ route('website.categories.show', $category->id) }}" class="btn btn-sm btn-outline-light m-1">{{ $category->title }}</a>
                @endforeach
            </div>
        </div>

        <!-- Subscribe (Newsletter) Section -->
        <div class="col-lg-4 col-md-6 mb-5">
            <h4 class="font-weight-bold mb-4">{{ __('words.subscribe') }}</h4>
            <p>{{ __('words.news_letter_footer') }}</p>
            <form class="newsletter">
                <div class="input-group">
                    <input type="email" class="form-control form-control-lg" placeholder="Your Email">
                    <div class="input-group-append">
                        <button class="btn btn-primary">Sign Up</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="row">
        <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
            <p class="mb-0">&copy; {{ date('Y') }} <a href="{{ route('website.index') }}" class="text-light">NEWSY</a>, All Rights Reserved.</p>
        </div>
        <div class="col-md-6 text-center text-md-right">
            <a href="#" class="text-light mr-3">Privacy Policy</a>
            <a href="#" class="text-light">Terms & Conditions</a>
        </div>
    </div>
</div>
<!-- Footer End -->

   

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-danger btn-lg-square back-to-top"><i class="fa fa-chevron-up"></i></a>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('front')}}/lib/easing/easing.min.js"></script>
    <script src="{{asset('front')}}/lib/owlcarousel/owl.carousel.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var languageIcon = document.getElementById('languageIcon');
        var languageDropdown = document.getElementById('languageDropdown');

        languageIcon.addEventListener('click', function() {
            // Toggle the 'show' class to display/hide the dropdown
            if (languageDropdown.classList.contains('show')) {
                languageDropdown.classList.remove('show');
            } else {
                languageDropdown.classList.add('show');
            }
        });

        // Close the dropdown if clicked outside
        document.addEventListener('click', function(event) {
            if (!languageIcon.contains(event.target) && !languageDropdown.contains(event.target)) {
                languageDropdown.classList.remove('show');
            }
        });
    });
</script>


    <!-- Template Javascript -->
    <script src="{{asset('front')}}/js/main.js"></script>
</body>

</html>
