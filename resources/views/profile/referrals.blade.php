@extends('frontends.templates.master')
@section('title', __('Referral'))
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
                <div id="referral" class="col-sm-8 content-acc">
                    <h3 class="sec-title">{{ __('Your Referral') }}</h3>
                    <div class="bg-grey">
                        <div class="row text-center justify-content-around">
                            <div class="col-6">
                                <p>{{ __('Turnover') }}</p>
                                <div class="bg-orange font-weight-bold">{{ format_currency($user->referrals->sum('amount')) }}</div>
                            </div>
                            <div class="col-6">
                                <p>{{ __('Account Balance') }}</p>
                                <div class="bg-orange font-weight-bold">{{ format_currency($user->amount) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 bg-grey">
                        <h4 class="sec-title2 mb-3">{{ __('Your Referral Link') }}</h4>
                        <input type="text" class="form-cs text-center" value="{{ route('referral_link',['ref'=>$user->name]) }}" readonly>
                    </div>
                    <div class="mt-5 bg-grey">
                        <h4 class="sec-title2 mb-3">{{ __('Referrals') }}</h4>
                        <div class="box-ct">
                            <table class="table">                            
                                <tbody>
                                    <tr>
                                        <td class="text-center dark-blue-bg font-weight-bold">{{ __('Username') }}</td>
                                        <td class="text-center dark-blue-bg font-weight-bold">{{ __('Email') }}</td>
                                        <td class="text-right dark-blue-bg font-weight-bold">{{ __('Registed Date') }}</td>
                                    </tr>
                                    @if($user_referrals)
                                        @foreach($user_referrals as $item)
                                            <tr>
                                                <td class="text-center dark-blue-bg">{{ $item->display_name() }}</td>
                                                <td class="text-center dark-blue-bg">{{ $item->email }}</td>
                                                <td class="text-right dark-blue-bg">{{ format_dateCS($item->created_at, 'yes') }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr><td colspan="3" class="text-center dark-blue-bg">{{ __('No referrals!') }}</td></tr>
                                    @endif                                    
                                </tbody>
                            </table>
                            <div class="mt-3 mb-3">{!! $user_referrals->links() !!}</div>
                            <div class="text-right"><a href="{{ route('profile.referral_history') }}" class="btn-cs btn-small">{{ __('Referrals History') }}</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
