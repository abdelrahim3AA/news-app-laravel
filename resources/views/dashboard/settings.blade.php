@extends('dashboard.layouts.layout')
@section('title', 'Setting')
@section('content')
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{__('words.dashboard')}}</li>
        <li class="breadcrumb-item"><a href="#">{{__('words.dashboard')}}</a>
        </li>
        <li class="breadcrumb-item active">داشبرد</li>

       
    </ol>


    <div class="container-fluid">

        <div class="animated fadeIn">
            <form action="{{Route('dashboard.settings.update' , $settings)}}" method="post" enctype="multipart/form-data">
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
                            <strong>{{ __('words.settings') }}</strong>
                        </div>
                        <div class="card-block">

                            <div class="form-group col-md-6">
                                <label>{{ __('words.logo') }}</label>
                                <img src="{{asset($settings->logo)}}" alt="" style="height: 50px">
                            </div>  
                            <div class="form-group col-md-6">
                                <label>{{ __('words.favicon') }}</label>
                                <img src="{{asset($settings->favicon)}}" alt="" style="height: 50px">
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('words.logo') }}</label>
                                <input type="file" name="logo" class="form-control" placeholder="Enter Email..">
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('words.favicon') }}</label>
                                <input type="file" name="favicon" class="form-control"
                                    placeholder="{{ __('words.favicon') }}" >
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('words.facebook') }}</label>
                                <input  type="text" name="facebook" class="form-control"
                                    placeholder="{{ __('words.facebook') }}" style="color:crimson;" value="{{$settings->facebook}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('words.instagram') }}</label>
                                <input  type="text" name="instagram" class="form-control"
                                    placeholder="{{ __('words.instagram') }}" style="color:crimson;" value="{{$settings->instagram}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('words.phone_number') }}</label>
                                <input type="text" name="phone" class="form-control"
                                    placeholder="{{ __('words.phone_number') }}" style="color:crimson;" value="{{$settings->phone}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('words.email') }}</label>
                                <input type="text" name="email" class="form-control"
                                    placeholder="{{ __('words.email') }}" style="color:crimson;" value="{{$settings->email}}">
                            </div>

                        </div>




                        <div class="card">
                            <div class="card-header">
                                <strong>{{ __('words.translations') }}</strong>
                            </div>
                            <div class="card-block">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">

                                    @foreach (config('app.languages') as $key => $lang)
                                        <li class="nav-item">
                                            <a class="nav-link @if ($loop->index == 0) active @endif"
                                                id="home-tab" data-toggle="tab" href="#{{ $key }}" role="tab"
                                                aria-controls="home" aria-selected="true">{{ $lang }}</a>
                                        </li>
                                    @endforeach

                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    @foreach (config('app.languages') as $key => $lang)
                                        <div class="tab-pane mt-3 fade @if ($loop->index == 0) show active in @endif"
                                            id="{{ $key }}" role="tabpanel" aria-labelledby="home-tab">
                                            <br>
                                            <div class="form-group mt-3 col-md-12">
                                                <label>{{ __('words.email') }} - {{ $lang }}</label>
                                                <input type="text" name="{{$key}}[title]" class="form-control"
                                                    placeholder="{{ __('words.email') }}" style="color:crimson;"  value="{{$settings->translate($key)->title}}">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>{{ __('words.content') }}</label>
                                                <textarea name="{{$key}}[content]" class="form-control" style="color:crimson;" cols="30" rows="10">{{$settings->translate($key)->content}}</textarea>
                                            </div>


                                            <div class="form-group col-md-12">
                                                <label>{{ __('words.address') }}</label>
                                                <input type="text"name="{{$key}}[address]" class="form-control"  style="color:crimson;" value="{{$settings->translate($key)->address}}">
                                            </div>
                                        </div>
                                    @endforeach

                                </div>



                            </div>


                            <div class="card-footer">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i>
                                    Submit</button>
                                <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i>
                                    Reset</button>
                            </div>

                        </div>

                    </div>
            </form>
        </div>
    </div>
    @endsection
