@extends('dashboard.layouts.layout')
@section('title', __('words.Create'))
@section('content')

    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{__('words.dashboard')}}</li>
        <li class="breadcrumb-item"><a href="#">{{__('words.posts')}}</a></li>
        <li class="breadcrumb-item active">{{__('words.create post')}}</li>
    </ol>

    <div class="container-fluid">
        <div class="animated fadeIn">
            <form action="{{route('dashboard.posts.store')}}" method="post" enctype="multipart/form-data">
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
                            <strong>{{ __('words.create post') }}</strong>
                        </div>
                        <div class="card-block">
                            <!-- For Image -->
                            <div class="form-group col-md-12">
                                <label>{{ __('words.image') }}</label>
                                <input type="file" name="image" class="form-control" placeholder="Enter Avatar..">
                            </div>

                            <!-- Select From Categories -->
                            <div class="form-group col-md-12">
                                <label>{{ __('words.categories') }}</label>
                                <select class="form-group col-md-12 " name="category_id" id="">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
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
                                            id="{{ $key }}-tab" data-toggle="tab" href="#{{ $key }}" role="tab"
                                            aria-controls="{{ $key }}" aria-selected="true">{{ $lang }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                @foreach (config('app.languages') as $key => $lang)
                                    <div class="tab-pane mt-3 fade @if ($loop->index == 0) show active in @endif"
                                        id="{{ $key }}" role="tabpanel" aria-labelledby="{{ $key }}-tab">
                                        <br>
                                        <div class="form-group col-md-12">
                                            <label>{{ __('words.title') }}</label>
                                            <input type="text" name="{{$key}}[title]" class="form-control" style="color:crimson;">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>{{ __('words.content') }}</label>
                                            <textarea name="{{$key}}[content]" class="form-control" style="color:crimson;" id="editor-{{ $key }}-content" cols="30" rows="10"></textarea>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>{{ __('words.small description') }}</label>
                                            <textarea name="{{$key}}[smallDesc]" class="form-control" id="editor-{{ $key }}-smallDesc" style="color:crimson;" cols="10" rows="3"></textarea>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>{{ __('words.tags') }}</label>
                                            <textarea name="{{$key}}[tags]" class="form-control" id="editor-{{ $key }}-tags" style="color:crimson;" cols="10" rows="3"></textarea>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success" type="submit">{{__('words.submit')}}</button>
            </form>
        </div>
    </div>
    @endsection
