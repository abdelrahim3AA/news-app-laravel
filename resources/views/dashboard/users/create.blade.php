@extends('dashboard.layouts.layout')
@section('title', 'Create')
@section('content')
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{__('words.dashboard')}}</li>
        <li class="breadcrumb-item"><a href="#">Users</a>
        </li>
        <li class="breadcrumb-item active">Create</li>

       
    </ol>


    <div class="container-fluid">

        <div class="animated fadeIn">
            <form action="{{Route('dashboard.users.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <div class="card">
                        <div class="card-header">
                            <strong>{{ __('words.create user') }}</strong>
                        </div>
                        <div class="card-block">
                            <div class="form-group col-md-12">
                                <label>{{ __('words.avatar') }}</label>
                                <input type="file" name="avatar" class="form-control" placeholder="Enter Avatar..">
                            </div>
                            
                            <div class="form-group col-md-12">
                                <label>{{ __('words.username') }}</label>
                                <input  type="text" name="username" class="form-control"
                                    placeholder="{{ __('words.username') }}" style="color:crimson;">
                            </div>
                            <div class="form-group col-md-12">
                                <label>{{ __('words.email') }}</label>
                                <input  type="text" name="email" class="form-control"
                                    placeholder="{{ __('words.email') }}" style="color:crimson;">
                            </div>
                            <div class="form-group col-md-12">
                                <label>{{ __('words.password') }}</label>
                                <input  type="password" name="password" class="form-control"
                                    placeholder="{{ __('words.password') }}" style="color:crimson;" value="{{ request('password') }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label>{{ __('words.phone_number') }}</label>
                                <input type="text" name="phone_number" class="form-control"
                                    placeholder="{{ __('words.phone_number') }}" style="color:crimson;" value="{{ request('phone_number') }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label>{{ __('words.status') }}</label>
                                <select class="form-group col-md-12 " name="status" id="">
                                    <option value="">{{ ucfirst(__('words.null')) }}</option>
                                    <option value="admin">{{ ucfirst(__('words.admin')) }}</option>
                                    <option value="writer">{{ ucfirst(__('words.writer')) }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success" type="submit">{{__('words.submit')}}</button>
            </form>
        </div>
    </div>
    @endsection
