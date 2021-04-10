@extends('frontends.templates.master')
@section('title', __('Make Deposit'))
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
                <div id="make-deposit" class="col-sm-8 content-acc">
                    <h3 class="sec-title">{{ __('Make Deposit') }}</h3>
                    <div class="list-plan row justify-content-center pb-4">
                        @if($plans)
                            @foreach($plans as $key => $plan)
                                <div class="col-4">@include('frontends.template-parts.plan')</div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('modals.modal_deposit')
@endsection
