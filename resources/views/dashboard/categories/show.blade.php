
@extends('dashboard.layouts.layout')

@section('title', 'Category Details')

@section('content')
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{__('words.dashboard')}}</li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">{{__('words.categories')}}</a></li>
        <li class="breadcrumb-item active">{{ __('Category: ' . $category->title) }}</li>
    </ol>

    <div class="container-fluid">
        <div class="animated fadeIn">
            <!-- Display Category Information -->
            <div class="card">
                <div class="card-header">
                    <strong>{{ __('Category Details') }}</strong>
                </div>
                <div class="card-block">
                    <h4><b>{{ $category->title }}</b></h4>
                    <p>{{ $category->description ?? __('No description available.') }}</p>
                    @if($category->image)
                        <img src="{{ asset($category->image) }}" alt="{{ $category->title }}" height="100px" width="100px">
                    @endif
                    <br><br>
                    <h5><b>Parent:</b> {{ $category->parent->title ?? 'Primary'}}</h5>
                    <h5><b>Created At:</b> {{ $category->created_at->format('Y-m-d H:i:s') }}</h5>
                </div>
            </div>

            <!-- Display Posts -->
            <div class="card mt-3">
                <div class="card-header">
                    <strong>{{ __('Posts in this Category') }}</strong>
                </div>
                <div class="card-block">
                    @if ($posts->isEmpty())
                        <p>{{ __('No posts available in this category.') }}</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Image') }}</th>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Content') }}</th>
                                    <th>{{ __('Small Description') }}</th>
                                    <th>{{ __('Created At') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td><img src="{{ asset($post->image) }}" alt="Post Image" width="60px" height="50px"></td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->content }}</td>
                                        <td>{{ $post->smallDesc }}</td>
                                        <td>{{ $post->created_at->format('Y-m-d H:i:s') }}</td>
                                        <td style="display:flex; justify-content:space-evenly">
                                            <a href="{{ route('dashboard.posts.edit', $post->id) }}" class="btn btn-outline-primary">{{ __('Edit') }}</a>
                                            <a href="#" class="btn btn-outline-warning">{{ __('Show') }}</a>
                                            <form action="{{ route('dashboard.posts.destroy', $post->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-outline-danger" onclick="return confirm('Do you want to delete this item?');">{{ __('Delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination Links -->
                        {{ $posts->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
