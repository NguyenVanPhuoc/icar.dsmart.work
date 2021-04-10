@extends('frontends.templates.master')
@section('title', __('Login'))
@section('content')
    <section class="page-banner" style="background:url('{{ asset('images-temp/header-bg.jpg') }}') center/cover no-repeat">
        <div class="container">
            <a href="{{ route('register') }}" class="btn-cs2">{{ __('Sign Up') }}<i class="far fa-check-square"></i></a>
        </div>
    </section>
    <section class="page-content pt-3">
        <div class="container">
            <h3 class="sec-title">{{ __('Login') }}</h3>
            @include('notices.index')
            <form method="POST" action="{{ route('login') }}" class="form-auth bg-grey" data-toggle="validator">
                @csrf
                <table>
                    <tbody>
                        <tr>
                            <td>{{ __('Username') }}</td>
                            <td><input class="form-cs" type="text" name="email" value="{{ Request::old('email') }}" required autofocus/></td>
                        </tr>
                        <tr>
                            <td>{{ __('Password') }}</td>
                            <td><input class="form-cs" type="password" name="password" required autocomplete="current-password" /></td>
                        </tr>                        
                        <tr>
                            <td></td>
                            <td><button type="submit" class="btn-cs">{{ __('Login') }}</button></td>
                        </tr>
                    </tbody>
                </table>
                @if (Route::has('password.request'))
                    <a class="forgot-pass" href="{{ route('password.request') }}">
                        {{ __('Forgot Password?') }}
                    </a>
                @endif                
            </form>
        </div>
    </section>
@endsection