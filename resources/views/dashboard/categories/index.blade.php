@extends('dashboard.layouts.layout')
@section('title', 'categories')

@section('content')

<div class="col-md-12">
    <div class="card shadow-lg" style="border-radius: 20px; background-color: #f7f7f7;">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center; padding: 1.5rem; background-color: #3a7bd5; color: white; border-top-left-radius: 20px; border-top-right-radius: 20px;">
            <h3>{{ __('words.categories') }}</h3>
            @can('create', App\Models\Category::class)
                <a href="{{ route('dashboard.categories.create') }}" class="btn btn-success" style="border-radius: 25px; padding: 10px 30px;">{{ __('words.create category') }}</a>
            @endcan
        </div>
        <!-- /.card-header -->

        <div class="card-body p-4" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">
            <table class="table table-bordered table-hover text-center" style="border-radius: 10px; overflow: hidden;">
                <thead style="background-color: #3a6073; color: white;">
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th>{{ __('words.image') }}</th>
                        <th>{{ __('words.title') }}</th>
                        <th>{{ __('words.parent') }}</th>
                        <th>{{ __('words.created_at') }}</th>
                        <th>{{ __('words.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td><img src="{{ asset($category->image) }}" alt="Category Image" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;"></td>
                        <td>{{ $category->title }}</td>
                        <td><a href="">{{ $category->parent->title ?? __('words.primary') }}</a></td>
                        <td>{{ $category->created_at->format('d M, Y') }}</td>
                        <td style="display: flex; justify-content: center; gap: 10px;">
                            @can('update', $category)
                                <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-outline-primary" style="border-radius: 25px; padding: 5px 20px;">{{ __('words.btnEdit') }}</a>
                            @endcan

                            @can('view', $category)
                            <a href="{{ route('dashboard.categories.show', $category->id) }}" class="btn btn-outline-warning" style="border-radius: 25px; padding: 5px 20px;">{{ __('words.btnShow') }}</a>
                            @endcan

                            @can('delete', $category)
                            <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post" style="display: inline;">
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
                {{ $categories->withQueryString()->links() }}
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

@endsection
