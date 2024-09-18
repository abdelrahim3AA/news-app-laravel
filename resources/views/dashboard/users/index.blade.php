@extends('dashboard.layouts.layout')
@section('title', 'users')

@section('content')

  <div class="col-md-12">
        <div class="card shadow-lg" style="border-radius: 20px; background-color: #f7f7f7;">
            <div class="card-header" style="display: flex; justify-content: space-between; align-items: center; padding: 1.5rem; background-color: #ccccb3; color: white; border-top-left-radius: 20px; border-top-right-radius: 20px;">
                <h3>{{ __('words.users') }}</h3>
                @can('create', Auth::user())
                    <a href="{{ route('dashboard.users.create') }}" class="btn btn-success" style="border-radius: 25px; padding: 10px 30px;">{{ __('words.create user') }}</a>
                @endcan
            </div>
            <!-- /.card-header -->

            <div class="card-body p-4" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">
                <table class="table table-bordered table-hover text-center" style="border-radius: 10px; overflow: hidden;">
                    <thead style="background-color: #3a6073; color: white;">
                        <tr>    
                            <th style="width: 5%;">#</th>
                            <th>{{ __('words.image') }}</th>
                            <th>{{ __('words.username') }}</th>
                            <th>{{ __('words.email') }}</th>
                            <th>{{ __('words.phone_number') }}</th>
                            <th>{{ __('words.status') }}</th>
                            <th>{{ __('words.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><img src="{{ asset($user->image) }}" alt="User_img" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;"></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone_number }}</td>
                            <td>{{ $user->status ? __('words.' . $user->status) : __('words.null') }}</td>
                            <td style="display: flex; justify-content: center; gap: 10px;">
                                @can('update', $user)
                                <a href="{{ route('dashboard.users.edit', $user->id) }}" class="btn btn-outline-primary" style="border-radius: 25px; padding: 5px 20px;">{{ __('words.btnEdit') }}</a>
                                @endcan

                                @can('view', $user)
                                <a href="#" class="btn btn-outline-warning" style="border-radius: 25px; padding: 5px 20px;">{{ __('words.btnShow') }}</a>
                                @endcan

                                @can('delete', $user)
                                <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="post" style="display: inline;">
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
                    {{ $users->withQueryString()->links() }}
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
