@extends('backends.templates.master')
@section('title', __('Edit Plan'))
@section('content')
@php $status = get_statusPost(); @endphp
<div id="create-store" class="content-wrapper stores">
    <section class="content">
        <div class="container">
            <div class="head">
                <a href="{{route('admin.plans')}}" class="back-icon"><i class="fas fa-angle-left" aria-hidden="true"></i>{{ __('All') }}</a>
                <h1 class="title">{{ __('Edit Plan') }}</h1>
            </div>
            <div class="main">
                @include('notices.index')
                <form action="{{ route('admin.plan_update',['id'=>$plan->id]) }}" name="createPage" class="dev-form" method="POST" data-toggle="validator" role="form">
                    @csrf
                    <div class="row">
                        <div class="col-md-9 content">
                            <div class="form-group">
                                <label class="control-label">{{ __('Title') }} <small>(*)</small></label>
                                <input type="text" name="title" value="{{ $plan->title }}" class="form-control" data-error="{{ __('Enter title')}}" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div id="frm-slug" class="form-group">
                                <label for="title">{{ __('Slug') }}<small class="required">(*)</small></label>
                                <div class="slug">
                                    <input type="text" name="slug" class="form-control" value="{{ $plan->slug }}" readonly="true" data-slug="{{ $plan->slug }}" data-action="{{ route('changeSlugAdmin',['id'=>$plan->post_id]) }}"/>
                                    <button class="btn-slug" data-value="{{ $plan->post_id }}">{{ __('edit') }}</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 form-group">
                                    <label class="control-label">{{ __('Minimum Deposit').' ('.get_option('currency').')' }} <small>(*)</small></label>
                                    <input type="number" name="min_deposit" value="{{ $plan->min_deposit }}" class="form-control" data-error="{{ __('Enter Minimum Deposit')}}" step="0.1" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="col-6 form-group">
                                    <label class="control-label">{{ __('Daily Profit (%)') }} <small>(*)</small></label>
                                    <input type="number" name="daily_profit" value="{{ $plan->daily_profit }}" class="form-control" data-error="{{ __('Enter Daily Profit')}}" step="0.01" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('Content') }}</label>
                                <textarea name="content" rows="10"  class="form-control editor">{!! $plan->content !!}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('Short description') }}</label>
                                <textarea name="excerpt" rows="10"  class="form-control">{{ isset($plan->post) ? $plan->post->excerpt : '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('SEO key') }}</label>
                                <input name="metaKey" type="text" class="form-control" value="{{ isset($plan->post) ? $plan->post->meta_key : '' }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('SEO content') }}</label>
                                <textarea name="metaValue" rows="10"  class="form-control">{{ isset($plan->post) ? $plan->post->meta_value : '' }}</textarea>
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
                                            {!! image($plan->image,230,230,__('Thumbnail')) !!}
                                            <input type="hidden" name="thumbnail" class="thumb-media" value="{{ $plan->image }}" />
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
                                            <option value="{{ $key }}"{{ isset($plan->post) && $plan->post->status == $key ? ' selected' : '' }}>{{ $value }}</option>
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