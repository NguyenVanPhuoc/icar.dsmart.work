@extends('frontends.templates.master')
@section('title', __('Deposits History'))
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
                <div id="ake-deposit" class="col-sm-8 content-acc">
                    <h3 class="sec-title">{{ __('Deposits History') }}</h3>
                    <div class="mt-4 box-ct">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-left dark-blue-bg font-weight-bold">{{ __('Investment Plan') }}</th>
                                    <th class="text-center dark-blue-bg font-weight-bold">{{ __('Daily Profit') }}</th>
                                    <th class="text-center dark-blue-bg font-weight-bold">{{ __('Amount') }}</th>
                                    <th class="text-center dark-blue-bg font-weight-bold">{{ __('Status') }}</th>
                                    <th class="text-right dark-blue-bg font-weight-bold">{{ __('Created Date') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($deposits)
                                    @foreach($deposits as $deposit)
                                        <tr>
                                            <td class="text-left dark-blue-bg">{{ isset($deposit->plan) ? $deposit->plan->title : $deposit->detail['planname'] }}</td>
                                            <td class="text-center dark-blue-bg">{{ $deposit->detail['profit'].'%' }}</td>
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
                        <div class="mt-3 mb-3">{!! $deposits->links() !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
