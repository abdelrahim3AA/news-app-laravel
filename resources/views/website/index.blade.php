@extends('website.layouts.layout')
@section('title', 'Index')
@section('content')

<!-- Custom Styles -->
<style>
    body {
        background-color: #1a1a1a;
        color: #e0e0e0;
    }

    h2 {
        color: #fff;
        font-size: 36px;
        font-weight: bold;
        margin-bottom: 30px;
    }

    .card-img-top {
        border-radius: 10px;
    }

    .card {
        border-radius: 12px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color: #2a2a2a;
        color: #e0e0e0;
    }

    .card:hover {
        transform: scale(1.03);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
    }

    /* Carousel Item Styling */
    .carousel-item-1, .carousel-item-3 {
        background-color: #333;
        border-radius: 8px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .carousel-item-1:hover, .carousel-item-3:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    .carousel-item-1 img, .carousel-item-3 img {
        border-radius: 8px;
    }

    .overlay .text-white {
        color: #ff6666;
    }

    /* Post card details */
    .post-details {
        font-size: 14px;
        color: #ccc;
        margin-top: 10px;
    }

    .post-details .author {
        color: #ff6666;
    }

    .post-details .tags {
        color: #999;
        font-size: 12px;
    }

    /* Buttons */
    .custom-btn {
        background-color: #ff6666;
        color: white;
        border-radius: 20px;
        padding: 5px 20px;
        font-size: 14px;
        transition: background-color 0.3s ease;
    }

    .custom-btn:hover {
        background-color: #cc3333;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .card {
            margin-bottom: 20px;
        }

        .carousel-item-1, .carousel-item-3 {
            font-size: 14px;
        }
    }
</style>
<!-- Top News Slider Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="owl-carousel owl-carousel-2 carousel-item-3 position-relative">
            @foreach ($lastFivePosts as $post)
                <div class="d-flex bg-dark text-light shadow-sm p-2" style="border-radius: 8px;">
                    <a class="text-secondary font-weight-semi-bold d-flex align-items-center" href="{{ route('website.posts.show', $post->id) }}">
                        <img src="{{ asset($post->image) }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px; margin-right: 10px;">
                        <span>{{ $post->title }}</span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Top News Slider End -->


<!-- Main News Slider Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="owl-carousel owl-carousel-2 carousel-item-1 position-relative mb-3 mb-lg-0">
                    @foreach ($lastFivePosts as $post)
                        <div class="position-relative overflow-hidden card" style="height: 435px;">
                            <img class="img-fluid h-100 w-100" src="{{ asset($post->image) }}" style="object-fit: cover;">
                            <div class="overlay">
                                <div class="mb-1">
                                    <a class="text-white" href="">{{ $post->category->title }}</a>
                                    <span class="px-2 text-white">/</span>
                                    <a class="text-white" href="">{{ $post->created_at->format('Y-m-d') }}</a>
                                </div>
                                <a class="h2 m-0 text-white font-weight-bold" href="">{{ $post->smallDesc }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                    <h3 class="m-0">{{ __('words.categories') }}</h3>
                    <a class="text-secondary font-weight-medium text-decoration-none" href="">View All</a>
                </div>
                @foreach ($categories->slice(0, 5) as $category)
                    <div class="position-relative overflow-hidden mb-3 card category-card" style="height: 80px;">
                        <img class="img-fluid w-100 h-100" src="{{ asset($category->image) }}" style="object-fit: cover;">
                        <a href="{{ route('website.categories.show', $category->id) }} " class="overlay align-items-center justify-content-center h4 m-0 text-white text-decoration-none">
                            {{$category->title}}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Main News Slider End -->

<!-- Category News Slider Start -->
<div class="container-fluid">
    <div class="container">
        <div class="row">
            @foreach ($categories_1 as $category)
                @if ($category->posts->isNotEmpty())
                    <div class="col-lg-6 py-3">
                        <!-- Category Card with Active Link -->
                        <div class="py-2 px-4 mb-3 card category-card" style="background-color: #333; color: #fff; border-radius: 12px;">
                            <h3 class="m-0">
                                <a href="{{ route('website.categories.show', $category->id) }}" class="text-danger" style="text-decoration: underline;">
                                    {{ $category->title }}
                                </a>
                            </h3>
                        </div>
                        
                        <!-- Posts Slider -->
                        <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">
                            @foreach ($category->posts->take(3) as $post)
                                <div class="position-relative card subcategory-card" style="background-color: #2a2a2a; border-radius: 10px; overflow: hidden;">
                                    <!-- Post Image -->
                                    <img class="img-fluid w-100" src="{{ asset($post->image) }}" style="object-fit: cover; height: 180px; border-radius: 10px 10px 0 0;">
                                    
                                    <!-- Post Details -->
                                    <div class="overlay position-relative p-3" style="background-color: #444; color: #e0e0e0;">
                                        <div class="mb-2" style="font-size: 13px;">
                                            <a href="{{ route('website.categories.show', $post->category->id) }}" class="text-danger">
                                                {{ $post->category->title }}
                                            </a>
                                            <span class="px-1">/</span>
                                            <span>{{ $post->created_at->format('F d, Y') }}</span>
                                        </div>
                                        <a class="h4 m-0 text-white" href="{{ route('website.posts.show', $post->id) }}">
                                            {{ $post->title }}
                                        </a>
                                        <div class="post-details mt-2">
                                            <span class="author font-weight-bold">{{ $post->user->name }}</span> |
                                            <span class="small-description">{{ $post->smallDesc }}</span>
                                            <div class="tags mt-2">Tags: {{ is_array($post->tags) ? implode(', ', $post->tags) : $post->tags }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
            <!-- Pagination Links -->
                <div class="d-flex justify-content-center">
                    {{ $categories_1->withQueryString()->links() }}
                </div>
        </div>
    </div>
</div>
<!-- Category News Slider End -->

@endsection
