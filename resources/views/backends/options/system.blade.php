@extends('backends.templates.master')
@section('title','System')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container">
            <div class="head">
                <h1 class="title">{{ __('System') }}</h1>
            </div>
            <div class="main">
                @include('notices.index')
                <form class="needs-validation dev-form" action="{{ route('admin.system_update') }}" name="editSystemAdmin" method="POST" role="form" novalidate>
                    @csrf
                    <div class="row logo-favicon">
                        <div id="frm-logo" class="col-md-6 form-group img-upload">
                            <label for="facebook">{{__('Logo')}}</label>
                            <div class="image">
                                <a href="{{ route('popupMediaAdmin') }}" class="library"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                {!! imageAuto($option['logo'],'Logo') !!}
                                <input type="hidden" name="logo" class="thumb-media" value="{{ $option['logo'] }}" />
                            </div>
                        </div>
                        <div id="frm-favicon" class="col-md-6 form-group img-upload">
                            <label for="favicon">{{__('Favicon')}}</label>
                            <div class="image">
                                <a href="{{ route('popupMediaAdmin') }}" class="library"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                {!! imageAuto($option['favicon'],'favicon') !!}
                                <input type="hidden" name="favicon" class="thumb-media" value="{{ $option['favicon'] }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 form-group">
                            <label>{{ __('Site Currency') }}</label>
                            <input type="text" name="currency" class="form-control" value="{{ $option['currency'] }}" />
                        </div>
                        <div class="col-md-6 orm-group">
                            <label>{{ __('Affiliate (%)') }}</label>
                            <input type="number" name="affiliate" class="form-control" value="{{ $option['affiliate'] }}" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label>{{ __('Site Name') }}</label>
                            <input type="text" name="site_name" class="form-control" value="{{ $option['site_name'] }}" />
                        </div>
                        <div class="form-group col-6">
                            <label>{{ __('Tag Site') }}</label>
                            <input type="text" name="tags" class="form-control" value="{{ $option['tags'] }}" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>{{ __('Hotline') }}</label>
                            <input type="text" name="hotline" class="form-control" value="{{ $option['hotline'] }}" />
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{ __('Email') }}</label>
                            <input type="email" name="email" class="form-control" value="{{ $option['email'] }}" />
                        </div>
                    </div>                                
                    <div class="form-group ">
                        <label>{{ __('Address') }}</label>
                        <textarea name="address" class="form-control" rows="10">{{ $option['address'] }}</textarea>
                    </div>
                    <div class="form-group ">
                        <label>{{ __('Social') }}</label>
                        <textarea name="socail" class="form-control" rows="10">{{ $option['socail'] }}</textarea>
                    </div>
                    <div class="row company-vertificate">
                        <div class="col-md-6 form-group">
                            <label>{{ __('Company Information') }}</label>
                            <textarea name="company_info" class="form-control" rows="10">{{ $option['company_info'] }}</textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>{{ __('CERTIFICATE') }}</label>
                            <textarea name="vertificate" class="form-control" rows="10">{{ $option['vertificate'] }}</textarea>
                        </div>
                    </div>
                    <div class="group-action">
                        @can('system.update')<button type="submit" name="submit" class="btn btn-success">{{ __('Save') }}</button>@endcan
                        <a href="{{ route('admin.system') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>							
                    </div>
                </form>	
            </div>
        </div>
    </section>
  </div>
  @include('backends.media.library')
@endsection