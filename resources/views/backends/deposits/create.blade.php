@extends('backends.templates.master')
@section('title', __('Add new Deposit'))
@section('content')
<div id="create-store" class="content-wrapper stores">
    <section class="content">
        <div class="container">
            <div class="head">
                <a href="{{route('admin.deposits')}}" class="back-icon"><i class="fas fa-angle-left" aria-hidden="true"></i>{{ __('All') }}</a>
                <h1 class="title">{{ __('Add new Deposit') }}</h1>
            </div>
            <div class="main">
                @include('notices.index')
                <form action="{{ route('admin.deposit_store') }}" name="createPage" class="dev-form" method="POST" data-toggle="validator" role="form">
                    @csrf
                    <div class="row">
                        <div class="col-md-9 content">
                            <div class="form-group">
                                <label class="control-label">{{ __('User') }} <small>(*)</small></label>
                                <select class="form-control select2" name="user_id" required>
                                    @foreach($users as $item) 
                                        <option value="{{ $item->id }}">{{ $item->displayname }}</option>
                                    @endforeach
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('Investment Plans') }} <small>(*)</small></label>
                                <select class="form-control select2" name="plan_id" required>
                                    @foreach($plans as $item) 
                                        <option value="{{ $item->id }}">{{ $item->title.' - '.$item->daily_profit.'%' }}</option>
                                    @endforeach
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">{!! __('Amount').' <small>('.get_option('currency').')</small>' !!}</label>
                                <input type="number" name="amount" class="form-control" data-error="{{ __('Input amount of request') }}" min="1" data-min-error="{{ __('Minimum value is 0') }}" value="10" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="group-action">
                                <button type="submit" name="submit" class="btn btn-success">{{ __('Save') }}</button>
                                <a href="{{ route('admin.deposits') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>	
                            </div>
                        </div>
                        <div class="col-md-3 sb-sidebar">
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
  </div>
  @include('backends.media.library')
@endsection