@extends('dashboard.layouts.layout')
@section('title', 'edit user profile')
@section('content')

<!-- Fullscreen Profile Page -->
<div class="profile-page" style="min-height: 100vh; background-color: #f0f4f8; display: flex; align-items: center; justify-content: center;">
    <!-- Profile Card -->
    <div class="card shadow-lg" style="width: 100%; max-width: 900px; background-color: #ffffff; border-radius: 20px;">
        <div class="card-header text-center" style="background-color: #4CAF50; color: white; border-top-left-radius: 20px; border-top-right-radius: 20px;">
            <h2>{{ __('edit profile') }}</h2>
        </div>
        <div class="card-body" style="padding: 2rem; background-color: #f7f9fc; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">
            
            <!-- Error Display Section -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('dashboard.users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="text-center mb-4">
                    <!-- Editable Profile Image -->
                    <label for="avatar" class="form-label">
                        <img src="{{ asset($user->image) }}" class="rounded-circle shadow" alt="User Avatar" style="height: 150px; width: 150px; object-fit: cover; border: 5px solid #4CAF50;">
                    </label>
                    <input type="file" name="avatar" id="avatar" class="form-control mt-2" style="width: 50%; margin: 0 auto;">
                </div>

                <!-- User Information Form -->
                <div class="row">
                    <!-- Username -->
                    <div class="col-md-6 mb-3">
                        <label for="name" style="margin:10px;" class="form-label"><strong>{{ __('username') }}:</strong></label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') ?? $user->name }}" style="border: 2px solid #4CAF50;">
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 mb-3">
                        <label for="email" style="margin:10px;" class="form-label"><strong>{{ __('email') }}:</strong></label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') ?? $user->email }}" style="border: 2px solid #4CAF50;">
                    </div>

                    <!-- Phone Number -->
                    <div class="col-md-6 mb-3">
                        <label for="phone_number" style="margin:10px;" class="form-label"><strong>{{ __('phone number') }}:</strong></label>
                        <input type="text" id="phone_number" name="phone_number" class="form-control" value="{{ old('phone_number') ?? $user->phone_number }}" style="border: 2px solid #4CAF50;">
                    </div>

                    @can('viewAny', $user)
                    <!-- Status -->
                    <div class="col-md-6 mb-3">
                        <label for="status" style="margin:10px;" class="form-label"><strong>{{ __('status') }}:</strong></label>
                        <select id="status" name="status" class="form-select" style="border: 2px solid #4CAF50; margin:10px;">
                            <option value="admin" @if($user->status == 'admin') selected @endif>{{ __('admin') }}</option>
                            <option value="writer" @if($user->status == 'writer') selected @endif>{{ __('writer') }}</option>
                        </select>
                    </div>
                    @endcan
                </div>

                <!-- Save and Cancel Buttons -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-lg btn-success" style="border-radius: 25px;margin:10px; padding: 10px 40px;">
                        {{ __('save profile') }}
                    </button>
                    <a href="{{ route('dashboard.users.index') }}" class="btn btn-lg btn-outline-success" style="border-radius: 25px; padding: 10px 40px; margin-left: 10px;">
                        {{ __('cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
