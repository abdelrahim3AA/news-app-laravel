@extends('website.layouts.layout')

@section('title', $category->title)

<style>
    /* Dark Mode Custom Styles */
    body {
        background-color: #121212; /* Dark background */
        color: #e0e0e0; /* Light text color for better readability */
    }
    .bg-dark {
        background-color: #212121 !important; /* Darker background */
    }
    .bg-light {
        background-color: #1e1e1e !important; /* Slightly lighter dark background */
    }
    .btn-primary, .btn-danger {
        background-color: #dc3545; /* Red button color */
        border-color: #dc3545;
    }
    .btn-primary:hover, .btn-danger:hover {
        background-color: #c82333; /* Darker red on hover */
        border-color: #bd2130;
    }
    .card {
        border: none;
        background-color: #1e1e1e; /* Dark gray card background */
        border-radius: 15px; /* More rounded corners */
        transition: transform 0.2s ease-in-out;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.5); /* Darker shadow for dark mode */
    }
    .card-img-top {
        height: 200px;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }
    .card-footer {
        border-top: 1px solid #333; /* Darker border */
        background-color: #212121;
    }
    .category-header {
        padding: 2rem;
        background: linear-gradient(135deg, #dc3545, #000); /* Red to black gradient */
        color: #fff;
        border-radius: 15px;
        margin-bottom: 2rem; /* Space below the category header */
    }
    .subcategory-card, .post-card {
        background-color: #1e1e1e; /* Dark gray card background */
        color: #e0e0e0; /* Light text color */
        border-radius: 15px;
    }
    .subcategory-card .card-body, .post-card .card-body {
        padding: 1.5rem;
    }
    .alert {
        background-color: #333; /* Dark background for alert */
        color: #e0e0e0; /* Light text color */
        border-color: #444; /* Darker border */
    }
    .topbar {
        background-color: #212121; /* Darker topbar background */
        color: #e0e0e0; /* Light text color */
        padding: 1rem;
        border-bottom: 1px solid #333; /* Darker border */
    }
    .topbar .logo {
        display: inline-block;
        vertical-align: middle;
    }
    .topbar .date {
        display: inline-block;
        vertical-align: middle;
        margin-left: auto;
    }
    .section-title {
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
        font-weight: 700;
        color: #dc3545; /* Red section title */
    }
    .card-link img {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }
</style>

@section('content')
<!-- Category Header Start -->
<div class="category-header">
    <div class="container">
        <h1 class="display-4">{{ $category->title }}</h1>
        <p class="lead">{{ __('words.desc_category') }}</p>
    </div>
</div>
<!-- Category Header End -->

<!-- Category Card Start -->
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card category-card shadow-lg">
                <img src="{{ asset($category->image) }}" class="card-img-top" alt="{{ $category->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $category->title }}</h5>
                    <p class="card-text">{{ $category->description }}</p>
                    <p class="card-text"><strong>{{ __('words.no_of_posts') }}</strong> {{ $category->posts->count() ?? 0 }}</p>
                    <p class="card-text"><strong>{{ __('words.no_of_categories') }}</strong> {{ $category->children->count() ?? 0 }}</p>
                    <p class="card-text"><strong>{{ __('words.created_at') }}: </strong> {{ $category->created_at->format('F d, Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Category Card End -->

<!-- Subcategories Start -->
<div class="container py-5">
    <h2 class="section-title"> {{ __('words.subcategories_in') . " " . ucfirst($category->title) }}</h2>
    @if ($category->children && $category->children->isEmpty())
        <div class="alert alert-danger" role="alert">
            {{ __('words.no_subcategories_available') }}
        </div>
    @elseif ($category->children)
        <div class="row">
            @foreach ($category->children as $child)
            <div class="col-md-4 mb-4">
                <div class="card subcategory-card shadow-lg">
                    <a href="{{ route('website.categories.show', $child->id) }}" class="card-link">
                        <img src="{{ asset($child->image) }}" class="card-img-top" alt="{{ $child->title }}" style="height: 180px; object-fit: cover;">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $child->title }}</h5>
                        <p class="card-text">{{ Str::limit($child->contnt, 100) }}</p>
                        <a href="{{ route('website.categories.show', $child->id) }}" class="btn btn-danger">View Subcategory</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
<!-- Subcategories End -->

<!-- Posts List Start -->
<div class="container py-5">
    <h2 class="section-title">{{ __('words.posts_in') . " " . ucfirst($category->title) }}</h2>
    @if ($category->posts && $category->posts->isEmpty())
        <div class="alert alert-danger" role="alert">
        {{ __('words.no_posts_available') }}
        </div>
    @elseif ($category->posts)
        <div class="row">
            @foreach ($category->posts as $post)
            <div class="col-md-4 mb-4">
                <div class="card post-card shadow-lg">
                    <img src="{{ asset($post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ Str::limit($post->smallDesc, 100) }}</p>
                        <a href="{{ route('website.posts.show', $post->id) }}" class="btn btn-danger">Read More</a>
                    </div>
                    <div class="card-footer rounded-bottom">
                        <small>{{ $post->created_at->format('F d, Y') }}</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
<!-- Posts List End -->
@endsection
