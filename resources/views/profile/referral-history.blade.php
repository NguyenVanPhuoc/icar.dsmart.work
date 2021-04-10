@extends('frontends.templates.master')
@section('title', __('Referrals History'))
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
            @include('notices.index')
            <div class="row">
                <div id="sidebar-acc" class="col-sm-4 bg-grey p-0">@include('profile.sidebar')</div>
                <div id="withdraw" class="col-sm-8 content-acc">
                    <h3 class="sec-title">{{ __('Referrals History') }}</h3>
                    <div class="mt-4 box-ct">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-left dark-blue-bg font-weight-bold">{{ __('From user') }}</th>
                                    <th class="text-center dark-blue-bg font-weight-bold">{{ __('Investment Plan') }}</th>
                                    <th class="text-center dark-blue-bg font-weight-bold">{{ __('Referral Rate') }}</th>
                                    <th class="text-center dark-blue-bg font-weight-bold">{{ __('Referral Turnover') }}</th>
                                    <th class="text-right dark-blue-bg font-weight-bold">{{ __('Created Date') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($referrals)
                                    @foreach($referrals as $item)
                                        <tr>
                                            <td class="text-left dark-blue-bg">
                                                {{ $item->deposit->user ? $item->deposit->user->display_name() : $item->description['username'] }}
                                            </td>
                                            <td class="text-center dark-blue-bg">
                                                @if($item->deposit->plan)
                                                    <a href="{{ route('profile.make_deposit') }}" title="{{ __('Make Deposit') }}">{{ $item->deposit->plan->title }}</a>
                                                @else
                                                    <a href="javascript:void(0)" title="{{ __('Plan has stopped') }}">{{ $item->description['planname'] }}</a>
                                                @endif
                                            </td>
                                            <td class="text-center dark-blue-bg">{{ $item->description['rate'].'%' }}</td>
                                            <td class="text-center dark-blue-bg">{{ format_currency($item->amount) }}</td>
                                            <td class="text-right dark-blue-bg">{{ format_dateCS($item->created_at, 'yes') }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="4" class="text-center dark-blue-bg">{{ __('No referrals!') }}</td></tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="mt-3 mb-3">{!! $referrals->links() !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
