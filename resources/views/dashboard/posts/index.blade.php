@extends('dashboard.layouts.layout')
@section('title', 'posts')

@section('content')

<!-- Flash Messages -->
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="col-md-12">
    <div class="card shadow-lg" style="border-radius: 20px; background-color: #f7f7f7;">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center; padding: 1.5rem; background-color: #3a7bd5; color: white; border-top-left-radius: 20px; border-top-right-radius: 20px;">
            <h3>{{ __('words.posts') }}</h3>
            <a href="{{ route('dashboard.posts.create') }}" class="btn btn-success" style="border-radius: 25px; padding: 10px 30px;">{{ __('words.create post') }}</a>
        </div>
        <!-- /.card-header -->

        <div class="card-body p-4" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">
            <table class="table table-bordered table-hover text-center" style="border-radius: 10px; overflow: hidden;">
                <thead style="background-color: #3a6073; color: white;">
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th>{{ __('words.image') }}</th>
                        <th>{{ __('words.title') }}</th>
                        <th>{{ __('words.content') }}</th>
                        <th>{{ __('words.small description') }}</th>
                        <th>{{ __('words.category name') }}</th>
                        <th>{{ __('words.created_at') }}</th>
                        <th>{{ __('words.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td><img src="{{ asset($post->image) }}" alt="Post Image" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;"></td>
                        <td>{{ $post->title }}</td>
                        <td>{{ Str::limit($post->content, 50) }}</td>
                        <td>{{ Str::limit($post->smallDesc, 50) }}</td>
                        <td><a href="{{ route('dashboard.categories.show', $post->category->id) }}">{{ $post->category->title }}</a></td>
                        <td>{{ $post->created_at->format('d M, Y') }}</td>
                        <td style="display: flex; justify-content: center; gap: 10px;">
                            <!-- Check if the user can edit the post -->
                            @can('update', $post)
                                <a href="{{ route('dashboard.posts.edit', $post->id) }}" class="btn btn-outline-primary" style="border-radius: 25px; padding: 5px 20px;">{{ __('words.btnEdit') }}</a>
                            @endcan

                            <!-- Check if the user can view the post -->
                            @can('view', $post)
                                <a href="{{ route('dashboard.posts.show', $post->id) }}" class="btn btn-outline-warning" style="border-radius: 25px; padding: 5px 20px;">{{ __('words.btnShow') }}</a>
                            @endcan

                            <!-- Check if the user can delete the post -->
                            @can('delete', $post)
                                <form action="{{ route('dashboard.posts.destroy', $post->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-outline-danger" style="border-radius: 25px; padding: 5px 20px;" onclick="if(!confirm('Do you want to delete this item')) return false;">{{ __('words.btnDelete') }}</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4 d-flex justify-content-center">
                {{ $posts->withQueryString()->links() }}
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endsection
