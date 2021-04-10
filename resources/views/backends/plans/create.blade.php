@extends('backends.templates.master')
@section('title', __('Add new Plan'))
@section('content')
@php $status = get_statusPost(); @endphp
<div id="create-store" class="content-wrapper stores">
    <section class="content">
        <div class="container">
            <div class="head">
                <a href="{{route('admin.plans')}}" class="back-icon"><i class="fas fa-angle-left" aria-hidden="true"></i>{{ __('All') }}</a>
                <h1 class="title">{{ __('Add new Plan') }}</h1>
            </div>
            <div class="main">
                @include('notices.index')
                <form action="{{ route('admin.plan_store') }}" name="createPage" class="dev-form" method="POST" data-toggle="validator" role="form">
                    @csrf
                    <div class="row">
                        <div class="col-md-9 content">
                            <div class="form-group">
                                <label class="control-label">{{ __('Title') }} <small>(*)</small></label>
                                <input type="text" name="title" value="{{ Request::old('title') }}" class="form-control" data-error="{{ __('Enter title')}}" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="row">
                                <div class="col-6 form-group">
                                    <label class="control-label">{{ __('Minimum Deposit').' ('.get_option('currency').')' }} <small>(*)</small></label>
                                    <input type="number" name="min_deposit" value="{{ Request::old('min_deposit') }}" class="form-control" data-error="{{ __('Enter Minimum Deposit')}}" step="0.1" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="col-6 form-group">
                                    <label class="control-label">{{ __('Daily Profit (%)') }} <small>(*)</small></label>
                                    <input type="number" name="daily_profit" value="{{ Request::old('daily_profit') }}" class="form-control" data-error="{{ __('Enter Daily Profit')}}" step="0.01" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('Content') }}</label>
                                <textarea name="content" rows="10"  class="form-control editor">{{ Request::old('content') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('Short description') }}</label>
                                <textarea name="excerpt" rows="10"  class="form-control">{{ Request::old('excerpt') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('SEO key') }}</label>
                                <input name="metaKey" type="text" class="form-control" value="{{ Request::old('metaKey') }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('SEO content') }}</label>
                                <textarea name="metaValue" rows="10"  class="form-control">{{ Request::old('metaValue') }}</textarea>
                            </div>
                            <div class="group-action">
                                <button type="submit" name="submit" class="btn btn-success">{{ __('Save') }}</button>
                                <a href="{{ route('admin.plans') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>	
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
                                            {!! image('',230,230,__('Thumbnail')) !!}
                                            <input type="hidden" name="thumbnail" class="thumb-media" value="" />
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
                                            <option value="{{ $key }}">{{ $value }}</option>
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