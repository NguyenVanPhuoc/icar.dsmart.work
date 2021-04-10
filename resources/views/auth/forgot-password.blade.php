@extends('frontends.templates.master')
@section('title', __('Forgot your password:'))
@section('content')
    <section class="page-banner" style="background:url('{{ asset('images-temp/header-bg.jpg') }}') center/cover no-repeat">
        <div class="container">
            <a href="{{ route('register') }}" class="btn-cs2">{{ __('Sign Up') }}<i class="far fa-check-square"></i></a>
        </div>
    </section>
    <section class="page-content pt-3">
        <div class="container">
            <h3 class="sec-title">{{ __('Forgot your password:') }}</h3>
            @include('notices.index')
            <form method="POST" action="{{ route('password.email') }}" id="form-forgot" class="form-auth bg-grey" data-toggle="validator">
                @csrf
                <table>
                    <tbody>
                        <tr>
                            <td>{{ __('Type your username or e-mail:') }}</td>
                            <td><input class="form-cs" type="text" name="email" value="{{ Request::old('email') }}" required autofocus/></td>
                        </tr>                     
                        <tr>
                            <td></td>
                            <td><button type="submit" class="btn-cs">{{ __('Forgot') }}</button></td>
                        </tr>
                    </tbody>
                </table>              
            </form>
        </div>
    </section>
@endsection
