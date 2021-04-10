@extends('backends.templates.master')
@section('title','create blog')
@section('content')
@php $status = get_statusPost(); $blogCats = get_blogCats();  @endphp
<div id="create-blog-cat" class="content-wrapper blog-cat">
    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="head">
                <a href="{{route('blogAdmin')}}" class="back-icon"><i class="fas fa-angle-left" aria-hidden="true"></i>{{__('Come back')}}</a>
                <h1 class="title">{{__('New blog')}}</h1>
            </div>
            <div class="main">
                @include('notices.index')
                <form action="{{ route('createBlogAdmin') }}" name="createBlog" class="dev-form" method="POST" data-toggle="validator" role="form">
                    @csrf
                    <div class="row">
                        <div class="col-md-9 content">
                            <div id="frm-title" class="form-group">
                                <label for="title" class="control-label">{{ __('Title') }}<small>(*)</small></label>
                                <input type="text" name="title" value="{{Request::old('title')}}" class="form-control" data-error="{{ __('Enter title')}}" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div id="frm-content" class="form-group">
                                <label for="content" class="control-label">{{ __('Content') }}</label>
                                <textarea name="content" rows="10"  class="form-control editor">{{Request::old('content')}}</textarea>
                            </div>
                            <div id="frm-metaKey" class="form-group">
                                <label for="metaKey">{{ __('SEO key') }}</label>
                                <input name="metaKey" type="text" class="form-control" value="{{Request::old('metaKey')}}">
                            </div>
                            <div id="frm-metaValue" class="form-group">
                                <label for="metaValue" class="control-label">{{ _('SEO content') }}</label>
                                <textarea name="metaValue" rows="10"  class="form-control">{{Request::old('metaValue')}}</textarea>
                            </div>
                            <div class="group-action">
                                <button type="submit" name="submit" class="btn btn-success">{{__('Okay')}}</button>
                                <a href="{{route('blogAdmin')}}" class="btn btn-secondary">{{__('Cancle')}}</a>	
                            </div>
                        </div>
                        <div class="col-md-3 sb-sidebar">
                            <aside id="sb-image" class="card card-outline card-info">
                                <div class="card-header">
                                    <h3 class="card-title">{{__('Thumbnail')}}</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="frm-avatar" class="img-upload">
                                        <div class="image">
                                            <a href="{{ route('popupMediaAdmin') }}" class="library"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                            {!!image('',230,230,'Thumbnail')!!}
                                            <input type="hidden" name="thumbnail" class="thumb-media" value="" />
                                        </div>
                                    </div>
                                </div>
                            </aside>
                            @if($blogCats)
                            <aside id="sb-proCat" class="card card-outline card-info">
                                <div class="card-header">
                                    <h3 class="card-title">{{__('Categories')}}</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @foreach($blogCats as $item)
                                    <div class="custom-control custom-checkbox item">
                                        <input id="item-{{$item->id}}" class="custom-control-input" type="checkbox" name="blogCats[{{$item->id}}]" value="{{$item->id}}">
                                        <label class="custom-control-label" for="item-{{$item->id}}">{{$item->title}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </aside>
                            @endif
                            @if(count($status)>0)
                            <aside id="sb-status" class="card card-outline card-info">
                                <div class="card-header">
                                    <h3 class="card-title">{{__('Status')}}</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <select class="form-control select2bs4" name="status">
                                        @foreach($status as $key => $value) 
                                        <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </aside>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  @include('backends.media.library')
@endsection