@extends('frontends.templates.master')
@section('title', __('Withdraw'))
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
                <div id="make-withdraw" class="col-sm-8 content-acc">
                    <h3 class="sec-title">{{ __('Withdraw') }}</h3>
                    <div class="bg-grey">
                        <div class="row text-center justify-content-around">
                            <div class="col-6">
                                <p>{{ __('Active Deposit') }}</p>
                                <div class="bg-orange font-weight-bold">{{ format_currency($active_deposit) }}</div>
                            </div>
                            <div class="col-6">
                                <p>{{ __('Account Balance') }}</p>
                                <div class="bg-orange font-weight-bold">{{ format_currency($user->amount) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 mb-5">
                        @include('notices.index')
                        <form action="{{ route('profile.make_withdraw') }}" method="POST" data-currency="{{ $currency }}">
                            @csrf
                            <table class="table table-borderless" cellspacing="2" cellpadding="2">
                                <tbody>
                                    <tr>
                                        <td class="bg-grey2 w-25">{{ __('Amount').':' }}</td>
                                        <td><input type="text" name="withdraw_amount" class="form-cs currency-format" required></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-grey2 w-25">{{ __('Content').':' }}</td>
                                        <td><textarea class="form-cs" rows="6" name="withdraw_content" placeholder="{{ __('Input your bank/account information') }}"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-grey2 w-25"></td>
                                        <td class="text-center">
                                            <button type="submit" class="btn-cs">{{ __('Send request') }}</button>                                        
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
