@extends('frontends.templates.master')
@section('title', __('Your account'))
@section('content')
    <section class="page-banner" style="background:url('{{ asset('images-temp/header-bg.jpg') }}') center/cover no-repeat">
        <div class="container">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="btn-cs2" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}  <i class="far fa-check-square"></i></a>
            </form>
        </div>
    </section>
    <section class="page-content pt-3">
        <div class="container">
            <div class="row">
                <div id="sidebar-acc" class="col-sm-4 bg-grey p-0">@include('profile.sidebar')</div>
                <div id="acc-update" class="col-sm-8 content-acc">
                    <h3 class="sec-title">{{ __('Your account') }}</h3>
                    @include('notices.index')
                    <form method="POST" action="{{ route('profile.update') }}" id="form-update" class="form-auth" data-toggle="validator">
                        @csrf
                        <table>
                            <tbody>
                                <tr>
                                    <td>{{ __('Account Name').':' }}</td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Registration date').':' }}</td>
                                    <td>{!! format_dateCS($user->created_at) !!}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Your Full Name').':' }}</td>
                                    <td class="form-group">
                                        <input type="text" name="displayname" class="form-cs" value="{{ $user->displayname }}" required data-error="{{ __('Please input Full name!') }}">
                                        <div class="help-block with-errors"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('New Password').':' }}</td>
                                    <td>
                                        <input type="password" name="password" id="password" class="form-cs">
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Retype Password').':' }}</td>
                                    <td class="form-group">
                                        <input type="password" name="password_confirmation" class="form-cs" data-match="#password" data-match-error="{{ __('Password confirm not match!') }}">
                                        <div class="help-block with-errors"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Your E-mail address').':' }}</td>
                                    <td>
                                        <input type="email" id="email" class="form-cs" value="{{ $user->email }}" disabled readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><button type="submit" class="btn-cs">{{ __('Update') }}</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
