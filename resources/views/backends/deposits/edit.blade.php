@extends('backends.templates.master')
@section('title', __('Edit Deposit'))
@section('content')
<div id="create-store" class="content-wrapper stores">
    <section class="content">
        <div class="container">
            <div class="head">
                <a href="{{route('admin.deposits')}}" class="back-icon"><i class="fas fa-angle-left" aria-hidden="true"></i>{{ __('All') }}</a>
                <h1 class="title">{{ __('Edit Deposit') }}</h1>
            </div>
            <div class="main">
                @include('notices.index')
                <form action="{{ route('admin.deposit_update',['id'=>$res->id]) }}" name="createPage" class="dev-form" method="POST" data-toggle="validator" role="form">
                    @csrf
                    <div class="row">
                        <div class="col-md-9 content">
                            <div class="form-group">
                                <label class="control-label">{{ __('User') }}</label>
                                <input type="text" class="form-control" value="{{ isset($res->user) ? $res->user->displayname : $res->detail['username'] }}" readonly disabled>
                                {{-- <select class="form-control select2" name="user_id">
                                    @if($res->user_id == NULL)
                                        <option value="">{{ isset($res->detail) ? $res->detail['username'] : __('Default') }}</option>
                                    @endif
                                    @foreach($users as $item) 
                                        <option value="{{ $item->id }}"{{ $res->user_id == $item->id ? ' selected' : '' }}>{{ $item->displayname }}</option>
                                    @endforeach
                                </select>
                                <div class="help-block with-errors"></div> --}}
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('Investment Plans').' - '.__('daily Profit') }}</label>
                                <input type="text" class="form-control" value="{{ isset($res->plan) ? $res->plan->title.' - '.$res->plan->daily_profit.'%' : $res->detail['planname'].' - '.$res->detail['profit'].'%' }}" readonly disabled>
                                {{-- <select class="form-control select2" name="plan_id">
                                    @if($res->plan_id == NULL)
                                        <option value="">{{ isset($res->detail) ? $res->detail['planname'] : 'Default' }}</option>
                                    @endif
                                    @foreach($plans as $item) 
                                        <option value="{{ $item->id }}"{{ $res->plan_id == $item->id ? ' selected' : '' }}>{{ $item->title.' - '.$item->daily_profit.'%' }}</option>
                                    @endforeach
                                </select>
                                <div class="help-block with-errors"></div> --}}
                            </div>
                            {{-- <div class="form-group">
                                <label class="control-label">{!! __('Amount').' <small>('.get_option('currency').')</small>' !!}</label>
                                <input type="number" name="amount" class="form-control" data-error="{{ __('Input amount of request') }}" min="1" data-min-error="{{ __('Minimum value is 0') }}" value="{{ $res->amount }}" required>
                                <div class="help-block with-errors"></div>
                            </div> --}}
                            <div class="form-group">
                                <label class="control-label">{!! __('Amount').' <small>('.get_option('currency').')</small>' !!}</label>
                                <input type="number" class="form-control" value="{{ $res->amount }}" disabled readonly>
                            </div>
                            <div class="group-action">
                                <button type="submit" name="submit" class="btn btn-success">{{ __('Save') }}</button>
                                <a href="{{ route('admin.deposits') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>    
                            </div>
                        </div>
                        <div class="col-md-3 sb-sidebar">
                            <aside class="card card-outline card-info">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('Stop Date') }}</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="input-group date" id="startDate" data-target-input="nearest">
                                        <input type="text" name="stop_date" class="form-control datetimepicker-input" data-target="#startDate" placeholder="{{ __('Choose Date') }}" value="{{ $res->stop_date }}"/>
                                        <div class="input-group-append" data-target="#startDate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </aside>
                            <aside class="card card-outline card-info">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('Created User') }}</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <input type="text" class="form-control" readonly value="{{ isset($res->auth) ? $res->auth->displayname : __('Default') }}">
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