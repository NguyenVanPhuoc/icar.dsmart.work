@extends('frontends.templates.master')
@section('title', __('Account Dashboard'))
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
                <div id="acc-dashboard" class="col-sm-8 content-acc">
                    <h3 class="sec-title">{{ __('Account Dashboard') }}</h3>
                    <div class="info">
                        <div class="dark-blue-bg d-flex p-3 align-content-center justify-content-center">
                            <div class="avatar">{!! image($user->image, 60,60, $user->displayname) !!}</div>
                            <div class="bg-grey username">{{ $user->name }}</div>
                        </div>
                        <div class="dark-blue-bg p-3 mt-2">
                            <table cellspacing="2" cellpadding="2">
                                <tbody>
                                    <tr>
                                        <td class="bg-grey2">{{ __('Registration Date').':' }}</td>
                                        <td class="bg-orange">{!! format_dateCS($user->created_at) !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-grey2">{{ __('Last Access').':' }}</td>
                                        <td class="bg-orange">{!! $user->last_login !!}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="bg-grey">
                        <div class="row text-center justify-content-around">
                            <div class="col-5">
                                <p>{{ __('Active Deposit') }}</p>
                                <div class="bg-orange font-weight-bold">{{ format_currency($active_deposit) }}</div>
                            </div>
                            <div class="col-5">
                                <p>{{ __('Account Balance') }}</p>
                                <div class="bg-orange font-weight-bold">{{ format_currency($user->amount) }}</div>
                            </div>
                            <div class="col-10 mt-3">
                                <p>{{ __('Earned Total') }}</p>
                                <div class="bg-grey3 font-weight-bold">{{ format_currency($earned_total) }}</div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('profile.make_deposit') }}" class="btn-cs2">{{ __('Deposit') }}</a>
                            <a href="{{ route('profile.withdraw') }}" class="btn-cs2">{{ __('Withdraw') }}</a>
                        </div>
                    </div>
                    <div class="bg-grey">
                        <h4 class="sec-title2 mb-3">{{ __('Latest Deposit') }}</h4>
                        <div class="box-ct">
                            <table class="table">
                                <tr>
                                    <td class="text-left dark-blue-bg font-weight-bold">{{ __('Investment Plan') }}</td>
                                    <td class="text-center dark-blue-bg font-weight-bold">{{ __('Amount') }}</td>
                                    <td class="text-center dark-blue-bg font-weight-bold">{{ __('Status') }}</td>
                                    <td class="text-right dark-blue-bg font-weight-bold">{{ __('Created Date') }}</td>
                                </tr>
                                <tbody>
                                    @if($user->deposits)
                                        @foreach($user->deposits as $deposit)
                                            <tr>
                                                <td class="text-left dark-blue-bg">{{ isset($deposit->plan) ? $deposit->plan->title : $deposit->detail['planname'] }}</td>
                                                <td class="text-center dark-blue-bg">{{ format_currency($deposit->amount) }}</td>
                                                <td class="text-center dark-blue-bg">{{ $deposit->isStopped() ? __('Stopped') : __('Active') }}</td>
                                                <td class="text-right dark-blue-bg">{{ format_dateCS($deposit->created_at, 'yes') }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr><td colspan="3" class="text-center dark-blue-bg">{{ __('No Deposits!') }}</td></tr>
                                    @endif                                    
                                </tbody>
                            </table>
                            <div class="text-right"><a href="{{ route('profile.deposits_history') }}" class="btn-cs btn-small">{{ __('See All') }}</a></div>
                        </div>
                    </div>
                    <div class="bg-grey">
                        <h4 class="sec-title2 mb-3">{{ __('Latest Withdrawals') }}</h4>
                        <div class="box-ct">
                            <table class="table">                            
                                <tbody>
                                    <tr>
                                        <td class="text-center dark-blue-bg font-weight-bold">{{ __('No') }}</td>
                                        <td class="text-center dark-blue-bg font-weight-bold">{{ __('Amount') }}</td>
                                        <td class="text-right dark-blue-bg font-weight-bold">{{ __('Created Date') }}</td>
                                    </tr>
                                    @if($user->transactions)
                                        @foreach($user->transactions as $key => $transaction)
                                            <tr>
                                                <td class="text-center dark-blue-bg">{{ $key + 1 }}</td>
                                                <td class="text-center dark-blue-bg">{{ format_currency($transaction->amount) }}</td>
                                                <td class="text-right dark-blue-bg">{{ format_dateCS($transaction->created_at, 'yes') }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr><td colspan="3" class="text-center dark-blue-bg">{{ __('No Deposits!') }}</td></tr>
                                    @endif                                    
                                </tbody>
                            </table>
                            <div class="text-right"><a href="{{ route('profile.withdraw_history') }}" class="btn-cs btn-small">{{ __('See All') }}</a></div>
                        </div>
                    </div>                
                </div>
            </div>
        </div>
    </section>
@endsection
