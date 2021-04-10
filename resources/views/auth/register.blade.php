@extends('frontends.templates.master')
@section('title', __('Registration'))
@section('content')
    <section class="page-banner" style="background:url('{{ asset('images-temp/header-bg.jpg') }}') center/cover no-repeat">
        <div class="container">
            <a href="{{ route('register') }}" class="btn-cs2">{{ __('Sign Up') }}<i class="far fa-check-square"></i></a>
        </div>
    </section>
    <section class="page-content pt-3">
        <div class="container">
            <h3 class="sec-title">{{ __('Registration at ') . get_option('site_name') . ':' }}</h3>
            @include('notices.index')
            <form method="POST" action="{{ route('register') }}" id="form-register" class="form-auth" data-toggle="validator">
                @csrf
                <div class="bg-grey">
                    <h4 class="sec-title2">{{ __('Account Information') }}</h4>
                    <div class="form-group">
                        <label>{{ __('Your Full Name').':' }}</label>
                        <input type="text" name="displayname" class="form-cs" value="{{ Request::old('displayname') }}" required data-error="{{ __('Please input Full name!') }}">
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Your Username').':' }}</label>
                        <input type="text" name="name" class="form-cs" value="{{ Request::old('name') }}" required data-error="{{ __('Please input Username!') }}">
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Define Password').':' }}</label>
                        <input type="password" name="password" id="password" class="form-cs" required data-error="{{ __('Please input Password!') }}">
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Retype Password').':' }}</label>
                        <input type="password" name="password_confirmation" class="form-cs" data-match="#password" required data-error="{{ __('Please retype Password!') }}" data-match-error="{{ __('Password confirm not match!') }}">
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Your E-mail Address').':' }}</label>
                        <input type="email" name="email" id="email" class="form-cs" value="{{ Request::old('email') }}" required data-error="{{ __('Please input Email!') }}">
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Retype Your E-mail').':' }}</label>
                        <input type="email" name="re_email" class="form-cs" data-match="#email" required data-error="{{ __('Please retype email!') }}" data-match-error="{{ __('Email confirm not match!') }}">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="form-check text-center form-group">
                    <input type="checkbox" class="form-check-input" id="policy" required data-error="{{ __('Please agree with Terms and conditions!') }}">
                    <label class="form-check-label" for="policy">{{ __('I agree with') }} <a href="#">{{ __('Terms and conditions') }}</a></label>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="text-center"><button type="submit" class="btn-cs">{{ __('Register') }}</button></div>
            </form>
        </div>
    </section>
@endsection
