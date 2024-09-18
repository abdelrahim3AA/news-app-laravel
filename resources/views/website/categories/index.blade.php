@extends('website.layouts.layout')
@section('title', 'All Categories')
@section('content')
<style>
    /* General styling */
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

    /* Category card styling */
    .category-card {
        border: 1px solid #333;
    }

    .category-card .card-body {
        padding: 20px;
    }

    .category-card .card-title {
        font-size: 24px;
        font-weight: bold;
        color: #ff6666;
    }

    .category-card .text-muted {
        font-size: 14px;
        color: #ccc;
    }

    .category-card .btn-show {
        background-color: #ff6666;
        color: #fff;
        border-radius: 20px;
        padding: 10px 20px;
        font-size: 14px;
        transition: background-color 0.3s ease;
    }

    .category-card .btn-show:hover {
        background-color: #cc3333;
    }

    /* Subcategory card styling */
    .subcategory-card {
        background-color: #333;
        border: 1px solid #444;
        border-radius: 8px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .subcategory-card:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    .subcategory-card .card-title {
        font-size: 16px;
        font-weight: bold;
        color: #ff6666;
    }

    .subcategory-card .text-muted {
        font-size: 12px;
        color: #ccc;
    }

    /* Button styling */
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

        .category-card .card-title {
            font-size: 20px;
        }

        .subcategory-card .card-title {
            font-size: 14px;
        }
    }
</style>

<div class="container py-5">
    <h2 class="text-center mb-5">{{ __('words.categories') }}</h2>
    
    <div class="row">
        @foreach ($categories_1 as $category)
        <!-- Category Card -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card category-card shadow-sm h-100 border-0">
                <!-- Make the image clickable and change cursor on hover -->
                <a href="{{ route('website.categories.show', $category->id) }}" class="category-link">
                    <img src="{{ asset($category->image) }}" class="card-img-top" alt="{{ $category->title }}" style="height: 180px; object-fit: cover;">
                </a>

                <div class="card-body text-center">
                    <h4 class="card-title">{{ $category->title }}</h4>
                    <p class="text-muted">{{ $category->posts->count() }} Posts</p>
                    <p class="card-text">{{ Str::limit($category->description, 80) }}</p>

                    <!-- "Show" Button -->
                    <a href="{{ route('website.categories.show', $category->id) }}" class="btn btn-show">Show</a>

                    <!-- Subcategory cards inside the main category -->
                    @if ($category->children->isNotEmpty())
                    <div class="subcategories mt-4">
                        <h5 class="mb-3">Subcategories</h5>
                        <div class="row">
                            @foreach ($category->children as $child)
                            <div class="col-md-6 col-sm-12">
                                <div class="card subcategory-card mb-3 shadow-sm">
                                    <a href="{{ route('website.categories.show', $child->id) }}" class="category-link">
                                        <img src="{{ asset($child->image) }}" class="card-img-top" alt="{{ $child->title }}" style="height: 100px; object-fit: cover;">
                                    </a>
                                    <div class="card-body p-2 text-center">
                                        <h6 class="card-title">{{ $child->title }}</h6>
                                        <p class="text-muted small">{{ $child->posts->count() }} Posts</p>
                                        <a href="{{ route('website.categories.show', $child->id) }}" class="btn btn-sm custom-btn">View</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
        <div class="d-flex justify-content-center">
            {{ $categories_1->withQueryString()->links() }}
        </div>
    </div>
</div>

@endsection
