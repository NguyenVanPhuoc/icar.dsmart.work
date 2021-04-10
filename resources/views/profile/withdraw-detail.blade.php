@extends('frontends.templates.master')
@section('title', __('Withdraw Detail'))
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
                <div id="withdraw-detail" class="col-sm-8 content-acc">
                    <h3 class="sec-title">{{ __('Withdraw Detail') }}</h3>
                    <div class="p-4 dark-blue-bg">
                        <table class="table" cellspacing="2" cellpadding="2">
                            <tbody>
                                <tr>
                                    <td class="bg-grey2 w-25">{{ __('Withdraw Date').':' }}</td>
                                    <td class="bg-orange">{!! format_dateCS($withdraw->created_at, 'yes') !!}</td>
                                </tr>
                                <tr>
                                    <td class="bg-grey2 w-25">{{ __('Amount').':' }}</td>
                                    <td class="bg-orange">{{ format_currency($withdraw->amount) }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-grey2 w-25">{{ __('Detail').':' }}</td>
                                    <td class="bg-orange">{!! $withdraw->content !!}</td>
                                </tr>
                                <tr>
                                    <td class="bg-grey2 w-25">{{ __('Status').':' }}</td>
                                    <td class="bg-orange">{{ $statuses[$withdraw->status] }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-grey2 w-25">{{ __('Documents').':' }}</td>
                                    <td class="bg-orange text-center">{!! imageAuto($withdraw->image, __('Documents')) !!}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center"><a href="{{ route('profile.withdraw_history') }}" class="btn-cs2">{{ __('See all') }}</a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
