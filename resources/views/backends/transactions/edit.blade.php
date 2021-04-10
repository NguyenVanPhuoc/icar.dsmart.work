@extends('backends.templates.master')
@section('title', __('Edit Transaction'))
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container">
            <div class="head">
                <a href="{{route('admin.transactions')}}" class="back-icon"><i class="fas fa-angle-left" aria-hidden="true"></i>{{ __('All') }}</a>
                <h1 class="title">{{ __('Edit Transaction') }}</h1>
            </div>
            <div class="main">
                @include('notices.index')
                <form action="{{ route('admin.transaction_update',['id'=>$transaction->id]) }}" name="createPage" class="dev-form" method="POST" data-toggle="validator" role="form">
                    @csrf
                    <div class="row">
                        <div class="col-md-9 content">
                            <div class="form-group">
                                <label class="control-label">{{ __('User') }} <small>(*)</small></label>
                                <input type="text" readonly disabled class="form-control" value="{{ isset($transaction->user) ? $transaction->user->displayname : $transaction->detail['username'] }}">
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">{!! __('Amount').' <small>('.get_option('currency').')</small>' !!}</label>
                                <input type="number" name="amount" class="form-control" data-error="{{ __('Input amount of request') }}" min="1" data-min-error="{{ __('Minimum value is 0') }}" value="{{ $transaction->amount }}" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('Description') }}</label>
                                <textarea name="content" rows="10"  class="form-control editor">{{ $transaction->content }}</textarea>
                            </div>
                            <div class="group-action">
                                <button type="submit" name="submit" class="btn btn-success">{{ __('Save') }}</button>
                                <a href="{{ route('admin.transactions') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>    
                            </div>
                        </div>
                        <div class="col-md-3 sb-sidebar">
                            @if(count($types)>0)
                                <aside id="sb-status" class="card card-outline card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">{{ __('Type') }}</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                            <i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" readonly disabled class="form-control" value="{{ $types[$transaction->type] }}">
                                    </div>
                                </aside>
                            @endif
                            @if(count($statuses)>0)
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
                                            @foreach($statuses as $key => $value) 
                                                <option value="{{ $key }}"{{ $transaction->status == $key ? ' selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </aside>
                            @endif
                            <aside id="sb-image" class="card card-outline card-info">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('Payment Receipt') }}</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="frm-avatar" class="img-upload">
                                        <div class="image">
                                            <a href="{{ route('popupMediaAdmin') }}" class="library"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                            {!! image($transaction->image,230,230,__('Payment Receipt')) !!}
                                            <input type="hidden" name="image" class="thumb-media" value="{{ $transaction->image }}" />
                                        </div>
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
  </div>
  @include('backends.media.library')
@endsection