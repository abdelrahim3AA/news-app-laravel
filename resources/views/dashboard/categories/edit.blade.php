@extends('dashboard.layouts.layout')
@section('title', __('words.edit category'))
@section('content')
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{__('words.dashboard')}}</li>
        <li class="breadcrumb-item"><a href="#">{{__('words.categories')}}</a>
        </li>
        <li class="breadcrumb-item active">{{__('words.edit category')}}</li>
    </ol>


    <div class="container-fluid">

        <div class="animated fadeIn">
            <form action="{{route('dashboard.categories.update', $category->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
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
                            <strong>{{ __('words.create category') }}</strong>
                        </div>
                        <div class="card-block">
                            <div>
                                <img src="{{ asset($category->image) }}" alt="" height="100px" width="100px">
                            </div>
                            <div class="form-group col-md-12">
                                <label>{{ __('words.image') }}</label>
                                <input type="file" name="image" class="form-control" placeholder="Enter Avatar..">
                            </div>

                            <div class="form-group col-md-12">
                                <label>{{ __('words.parent') }}</label>
                                <select class="form-group col-md-12 " name="parent_id" id="">
                                    <option value="" @if ($category->parent_id == 0 || $category->parent_id == null) selected 
                                        @endif >{{ ucfirst(__('words.primary')) }}</option>
                                    @foreach ($categories as $item)
                                        @if (!($item->title === $category->title))
                                            <option value="{{ $item->id }}" @if ($category->parent_id == $item->id) selected 
                                            @endif >{{ $item->title }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
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
                                            <div class="form-group col-md-12">
                                                <label>{{ __('words.title') }}</label>
                                                <input type="text" name="{{$key}}[title]" class="form-control"  style="color:crimson;" value="{{ old($key."[title]") ?? $category->title }}">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>{{ __('words.content') }}</label>
                                                <textarea name="{{$key}}[content]" class="form-control" style="color:crimson;" cols="30" rows="10"> {{ old($key."[content]") ?? $category->content }} </textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>


                            <!-- <div class="card-footer">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i>
                                    Submit</button>
                                <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i>
                                    Reset</button>
                            </div> -->
                        </div>
                    <button class="btn btn-success" type="submit">{{__('words.submit')}}</button>
            </form>
        </div>

    </div>
    @endsection
