@extends('backends.templates.master')
@section('title', __('Create New User'))
@section('content')
<div class="content-wrapper users">
    <section class="content">
        <div class="container">
            <div class="head">
                <a href="{{route('admin.users')}}" class="back-icon"><i class="fas fa-angle-left" aria-hidden="true"></i>{{ __('All') }}</a>
                <h1 class="title">{{ __('Create New User') }}</h1>
            </div>
            <div class="main">
                @include('notices.index')
                <form action="{{ route('admin.user_create') }}" class="dev-form" method="POST" data-toggle="validator" role="form">
                    @csrf
                    <div class="row">
                        <div class="col-md-9 content">
                            <div class="form-group">
                                <label class="control-label">{{ __('Name') }} <small>({{ __('required') }})</small></label>
                                <input type="text" name="name" value="{{ Request::old('name') }}" class="form-control" data-error="{{ __('Please input username!') }}" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('Display name') }} <small>({{ __('required') }})</small></label>
                                <input type="text" name="displayname" value="{{ Request::old('displayname') }}" class="form-control" data-error="{{ __('Please input Display name!') }}" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('Phone Number') }} <small>({{ __('required') }})</small></label>
                                <input type="text" name="phone" value="{{ Request::old('phone') }}" class="form-control" data-error="{{ __('Please input phone number!') }}" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('Email') }} <small>({{ __('required') }})</small></label>
                                <input type="email" name="email" value="{{ Request::old('email') }}" class="form-control" data-error="{{ __('Please input user email!') }}" required>
                                <div class="help-block with-errors"></div>
                            </div>                            
                            <div class="form-group">
                                <label class="control-label">{{ __('Address') }}</label>
                                <input type="text" name="address" value="{{ Request::old('address') }}" class="form-control">
                            </div>                        
                            <div class="form-group">
                                <label for="password" class="control-label">{{ __('Password') }} <small>({{ __('required') }})</small></label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="***" data-error="{{ __('Input password') }}" data-minlength="8" data-minlength-error="{{ __('Min length is 8 character') }}" required>
                                <div class="help-block with-errors"></div>
                            </div>			
                            <div  class="form-group" >
                                <label for="confirmPassword" class="control-label">{{ __('Confirm Password') }} <small>({{ __('required') }})</small></label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="***"  data-match="#password" data-error="{{ __('Confirm password')}}"  data-minlength="8" data-minlength-error="{{ __('Min length is 8 character') }}" data-match-error="{{ __('Password confirm not match!') }}" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="group-action">
                                <button type="submit" name="submit" class="btn btn-success">{{ __('Save') }}</button>
                                <a href="{{ route('admin.users') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>	
                            </div>
                        </div>
                        <div class="col-md-3 sb-sidebar">
                            <aside class="card card-outline card-info">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('Role') }}</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <select class="form-control select2" name="role" data-error="{{ __('Please choose user role') }}" required>
                                        <option value="" selected disabled>{{ __('Choose role') }}</option>
                                        @if($roles)
                                            @foreach($roles as $role)
                                                <option value="{{ $role->name }}">{{ $role->display_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </aside>
                            <aside id="sb-image" class="card card-outline card-info">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('Avatar') }}</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="frm-avatar" class="img-upload">
                                        <div class="image">
                                            <a href="{{ route('popupMediaAdmin') }}" class="library"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                            {!! image('',230,230,__('Avatar')) !!}
                                            <input type="hidden" name="image" class="thumb-media" value="" />
                                        </div>
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
  </div>
  @include('backends.media.library')
@endsection