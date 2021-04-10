@extends('frontends.templates.master')
@section('title', __('Recharge Request'))
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
                <div id="make-recharge" class="col-sm-8 content-acc">
                    <h3 class="sec-title">{{ __('Recharge request') }}</h3>
                    <div class="p-4 mb-5">
                        @include('notices.index')
                        <form action="{{ route('profile.make_recharge') }}" method="POST" data-currency="{{ $currency }}">
                            @csrf
                            <table class="table table-borderless" cellspacing="2" cellpadding="2">
                                <tbody>
                                    <tr>
                                        <td class="bg-grey2 w-25">{{ __('Amount').':' }}</td>
                                        <td><input type="text" name="recharge_amount" class="form-cs currency-format" required></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-grey2 w-25">{{ __('Content').':' }}</td>
                                        <td><textarea class="form-cs" rows="6" name="recharge_content" placeholder="{{ __('Description your request') }}"></textarea></td>
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
                    <div class="p-4 mb-5">
                        <h3 class="sec-title">{{ __('Recharge Request') }}</h3>
                        <div class="mt-4 box-ct">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-left dark-blue-bg font-weight-bold">{{ __('Amount') }}</th>
                                        <th class="text-center dark-blue-bg font-weight-bold">{{ __('Content') }}</th>
                                        <th class="text-center dark-blue-bg font-weight-bold">{{ __('Documents') }}</th>
                                        <th class="text-center dark-blue-bg font-weight-bold">{{ __('Status') }}</th>
                                        <th class="text-right dark-blue-bg font-weight-bold">{{ __('Request Date') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($recharges)
                                        @foreach($recharges as $item)
                                            <tr>
                                                <td class="text-left dark-blue-bg"><a href="{{ route('profile.withdraw_detail',['withdraw_id'=>$item->id]) }}">{{ format_currency($item->amount) }}</a></td>
                                                <td class="text-center dark-blue-bg"><a href="{{ route('profile.withdraw_detail',['withdraw_id'=>$item->id]) }}">{!! str_limit($item->content, 30, '...') !!}</a></td>
                                                <td class="text-center dark-blue-bg">
                                                    @if($item->image != null)
                                                        <a href="{{ url_img($item->image) }}" target="_blank">{!! image($item->image, 40, 40) !!}</a>
                                                    @endif
                                                </td>
                                                <td class="text-center dark-blue-bg">{{ $statuses[$item->status] }}</td>
                                                <td class="text-right dark-blue-bg">{{ format_dateCS($item->created_at, 'yes') }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr><td colspan="5" class="text-center dark-blue-bg">{{ __('No items!') }}</td></tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="mt-3 mb-3">{!! $recharges->links() !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
