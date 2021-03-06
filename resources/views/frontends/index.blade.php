@extends('frontends.templates.master')
@section('title',$page->title)
@section('keywords',$page->meta_key)
@section('description',$page->meta_value)
@section('content')
<section id="home-slide" style="background-image:url('{{url_img($page->image_id)}}')">
    <div class="container">
        <div class="wrap">{!!$page->excerpt!!}</div>
    </div>
</section>
<section id="home-services" class="sec-block">
    <div class="container">
        <div class="row">
            <div class="col-md-4 block">{!!get_fieldContent('home_company')!!}</div>
            <div class="col-md-4 block">{!!get_fieldContent('home_business')!!}</div>
            <div class="col-md-4 block">{!!get_fieldContent('home_roi')!!}</div>
        </div>
    </div>
</section>
<section id="home-aboutUs" class="sec-block">
    <div class="container">
        <h2 class="sec-title">About <span>ICAR</span> Digital LTD</h2>
        <div class="row sec-content">
            <div class="col-md-6">{!!imageAuto(get_fieldContent('home_about_img'),'')!!}</div>
            <div class="col-md-6">{!!get_fieldContent('home_about_text')!!}</div>
        </div>
    </div>
</section>
<section id="home-plans" class="sec-block plans">
    <div class="container">
        <h2 class="sec-title">{!!get_fieldContent('home_sec_title_02')!!}</span></h2>
        @include('notices.index')
        <div class="row sec-content" id="make-deposit">
            @if($plans)
                @foreach($plans as $key => $plan)
                    <div class="col-md-3">@include('frontends.template-parts.plan')</div>
                @endforeach
            @endif
        </div>
    </div>
</section>
<section id="home-affiates" class="sec-block affiates">
    <div class="container"><h2 class="sec-title">{!!get_fieldContent('home_sec_title_03')!!}</h2></div>
    <div class="sec-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 rewards-txt">Career rewards:</div>
                @if($affiates)
                    @foreach($affiates as $item)
                    <div class="col-md-2 block">
                        <div class="wrap">
                            <h3>{{$item->title}}</h3>
                            <div class="thumb">{!!imageAuto($item->image_id,$item->title)!!}</div>
                            <p class="turnover-num">Turnover: {{format_currency($item->turnover)}}</p>
                            <p class="rewards-num">Rewards: {{format_currency($item->rewards)}}</p>
                        </div>
                    </div>
                    @endforeach
                @endif
                <div class="col-md-12">
                    <p class="turnover-txt">** Turnover: The total investment amount of direct referrals.</p>
                    <div class="ref-info">Referral commission<span>{{ get_option('affiliate') }}%</span></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="home-features" class="sec-block features">
    <div class="container sec-content">
        <div class="row">
            <div class="col-md-4 block">
                <div class="sub-block">
                    {!!imageAuto(get_fieldContent('home_feature_img_01'),'')!!}
                    <p>{!!get_fieldContent('home_feature_text_01')!!}</p>
                </div>
                <div class="sub-block">
                    {!!imageAuto(get_fieldContent('home_feature_img_02'),'')!!}
                    <p>{!!get_fieldContent('home_feature_text_02')!!}</p>
                </div>
                <div class="sub-block">
                    {!!imageAuto(get_fieldContent('home_feature_img_03'),'')!!}
                    <p>{!!get_fieldContent('home_feature_text_03')!!}</p>
                </div>
            </div>
            <div class="col-md-4 block">{!!imageAuto(get_fieldContent('home_feature_img_07'),'')!!}</div>
            <div class="col-md-4 block">
                <div class="sub-block">
                    {!!imageAuto(get_fieldContent('home_feature_img_04'),'')!!}
                    <p>{!!get_fieldContent('home_feature_text_04')!!}</p>
                </div>
                <div class="sub-block">
                    {!!imageAuto(get_fieldContent('home_feature_img_05'),'')!!}
                    <p>{!!get_fieldContent('home_feature_text_05')!!}</p>
                </div>
                <div class="sub-block">
                    {!!imageAuto(get_fieldContent('home_feature_img_06'),'')!!}
                    <p>{!!get_fieldContent('home_feature_text_06')!!}</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="home-transaction" class="sec-block transactions">
    <div class="container">
        <h2 class="sec-title">{!!get_fieldContent('home_sec_title_04')!!}</h2>
        <div class="sec-content">
            <div class="row top-trans">
                <div class="col-md-3 block">{!!get_fieldContent('home_online_01')!!}</div>
                <div class="col-md-3 block">{!!get_fieldContent('home_online_02')!!}</div>
                <div class="col-md-3 block">{!!get_fieldContent('home_online_03')!!}</div>
                <div class="col-md-3 block">{!!get_fieldContent('home_online_04')!!}</div>
            </div>
            <div class="row bottom-trans">
                <div class="col-md-6 block block-deposits">
                    <div class="wrap">
                        <h3>{{__('Last Deposits')}}</h3>
                        @if($deposits->count() > 0)
                            <ul class="list-trans">
                                @foreach($deposits as $item)
                                    <li class="item">
                                        <div class="name">{{ isset($item->user) ? $item->user->displayname : $item->detail['username'] }}</div>
                                        <div class="coin">{{ $item->amount }}<span>{{ get_option('currency') }}</span></div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="col-md-6 block block-withdrawals">
                    <div class="wrap">
                        <h3>{{__('Last Withdrawals')}}</h3>
                        @if($withdrawals->count() > 0)
                            <ul class="list-trans">
                                @foreach($withdrawals as $item)
                                    <li class="item">
                                        <div class="name">{{ isset($item->user) ? $item->user->displayname : 'Customer' }}</div>
                                        <div class="coin">{{ $item->amount }}<span>{{ get_option('currency') }}</span></div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-center">{{ __('No items!') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('modals.modal_deposit')
@endsection