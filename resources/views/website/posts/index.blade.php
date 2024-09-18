@extends('website.layouts.layout')

@section('title', $post->title)

<style>
    /* Dark Mode Custom Styles */
    body {
        background-color: #121212; /* Dark background */
        color: #e0e0e0; /* Light text color */
    }
    .bg-dark {
        background-color: #212121 !important; /* Darker background */
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
        border-radius: 15px; /* Rounded corners */
        padding: 1.5rem;
        transition: transform 0.2s ease-in-out;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.7); /* Darker shadow for dark mode */
    }
    .card-img-top {
        border-radius: 16px;
        max-width: 900px !important;
        height: 500px;
    }
    .post-header {
        padding: 2rem;
        background: linear-gradient(135deg, #dc3545, #000); /* Red to black gradient */
        color: #fff;
        border-radius: 15px;
        text-align: center;
    }
    .post-title {
        font-size: 2rem;
        font-weight: 700;
    }
    .post-meta {
        color: #e0e0e0;
        font-size: 0.9rem;
    }
    .content {
        padding: 2rem;
    }
    .tags {
        margin-top: 1rem;
        display: flex;
        flex-wrap: wrap;
    }
    .tags .tag {
        background-color: #dc3545; /* Red background */
        color: #fff;
        border-radius: 5px;
        padding: 0.5rem 1rem;
        margin: 0.25rem;
        font-size: 0.9rem;
    }
    .related-posts {
        margin-top: 3rem;
    }
    .related-posts .card {
        background-color: #1e1e1e; /* Dark gray card background */
        border-radius: 10px; /* Rounded corners */
        padding: 1rem; /* Padding for better spacing */
    }
    .related-posts .card-img-top {
        height: 200px; /* Larger image height for better visibility */
        border-radius: 10px;
    }
    .alert {
        background-color: #333; /* Dark background for alert */
        color: #e0e0e0; /* Light text color */
        border-color: #444; /* Darker border */
    }
    .section-title {
        color: #dc3545; /* Red color for section title */
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }
</style>

@section('content')
<!-- Post Header Start -->
<div class="post-header">
    <div class="container">
        <h1 class="post-title">{{ $post->title }}</h1>
        <img src="{{ asset($post->image) }}" class="card-img-top" alt="{{ $post->title }}">
            <hr style="width: 100%; border: 1px solid #dc3545; margin: 20px 0;">

        <div class="post-meta">
            <p>Category: {{ $post->category->title }}</p>
            <p>Author: {{ $post->user->name }}</p>
            <p>Created At: {{ $post->created_at->format('F d, Y') }}</p>
        </div>
    </div>
</div>
<!-- Post Header End -->
<!-- Post Content Start -->
<div class="container py-5">
    <div class="card">
        <div class="content">

            <!-- Description Section (Only if $post->smallDesc is present) -->
            @if (!empty($post->smallDesc))
                <div class="post-description">
                    <h3>Description:</h3>
                    <p class="small-desc">{{ $post->smallDesc }}</p>
                </div>
                <hr style="width: 100%; border: 1px solid #dc3545; margin: 20px 0;">
            @endif

            <!-- Content Section (Only if $post->content is present) -->
            @if (!empty($post->content))
                <div class="post-content">
                    <h3>Content:</h3>
                    {!! $post->content !!}
                </div>
                <hr style="width: 100%; border: 1px solid #dc3545; margin: 20px 0;">
            @endif

            <!-- Tags Section (Only if there are tags) -->
            @if ($tags && count($tags) > 0)
                <div class="post-tags">
                    <h3>Tags:</h3>
                    <div class="tags">
                        @foreach ($tags as $tag)
                            <span class="tag">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
<!-- Post Content End -->



<!-- Related Posts Start -->
<div class="container py-5 related-posts">
    <h2 class="section-title">Related Posts in {{ $post->category->title }}</h2>
    @if ($relatedPosts && $relatedPosts->isEmpty())
        <div class="alert alert-danger" role="alert">
            No related posts available for this category.
        </div>
    @else
        <div class="row">
            @foreach ($relatedPosts as $relatedPost)
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg">
                    <a href="{{ route('website.posts.show', $relatedPost->id) }}">
                        <img src="{{ asset($relatedPost->image) }}" class="card-img-top" alt="{{ $relatedPost->title }}">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $relatedPost->title }}</h5>
                        <p class="card-text">{{ Str::limit($relatedPost->smallDesc, 100) }}</p>
                        <a href="{{ route('website.posts.show', $relatedPost->id) }}" class="btn btn-danger">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
<!-- Related Posts End -->
@endsection
