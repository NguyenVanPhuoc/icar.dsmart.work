@extends('backends.templates.master')
@section('title', __('Edit Affiate'))
@section('content')
@php $status = get_statusPost(); @endphp
<div id="create-affiates" class="content-wrapper stores">
    <section class="content">
        <div class="container">
            <div class="head">
                <a href="{{route('affiateAdmin')}}" class="back-icon"><i class="fas fa-angle-left" aria-hidden="true"></i>{{ __('All') }}</a>
                <h1 class="title">{{ __('Edit Affiate') }}</h1>
            </div>
            <div class="main">
                @include('notices.index')
                <form action="{{ route('editAffiateAdmin',['id'=>$affiate->id]) }}" name="editPage" class="dev-form" method="POST" data-toggle="validator" role="form">
                    @csrf
                    <div class="row">
                        <div class="col-md-9 content">
                            <div class="form-group">
                                <label class="control-label">{{ __('Title') }} <small>(*)</small></label>
                                <input type="text" name="title" value="{{$affiate->title}}" class="form-control" data-error="{{ __('Enter title')}}" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('Turnover') }} <small>(*)</small></label>
                                <input type="number" name="turnover" value="{{ $affiate->turnover}}" class="form-control" data-error="{{ __('Enter turnover')}}" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('Rewards') }} <small>(*)</small></label>
                                <input type="number" name="rewards" value="{{ $affiate->rewards }}" class="form-control" data-error="{{ __('Enter rewards')}}"required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="group-action">
                                <button type="submit" name="submit" class="btn btn-success">{{ __('Save') }}</button>
                                <a href="{{ route('affiateAdmin') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>	
                            </div>
                        </div>
                        <div class="col-md-3 sb-sidebar">
                            <aside id="sb-image" class="card card-outline card-info">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('Thumbnail') }}</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="frm-avatar" class="img-upload">
                                        <div class="image">
                                            <a href="{{ route('popupMediaAdmin') }}" class="library"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                            {!! image($affiate->image_id,230,230,__('Thumbnail')) !!}
                                            <input type="hidden" name="thumbnail" class="thumb-media" value="{{$affiate->image_id}}" />
                                        </div>
                                    </div>
                                </div>
                            </aside>
                            @if(count($status)>0)
                            <aside id="sb-status" class="card card-outline card-info">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('Status') }}</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <select class="form-control select2" name="status">
                                        @foreach($status as $key => $value) 
                                        <option value="{{$key}}"@if($key==$affiate->status){{__(' selected')}}@endif>{{$value}}</option>
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
  </div>
  @include('backends.media.library')
@endsection