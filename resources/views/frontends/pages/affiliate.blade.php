@extends('frontends.templates.master')
@section('title',$data->title)
@section('keywords',$data->meta_key)
@section('description',$data->meta_value)
@section('content')
@php
$affiates = get_affiates(16);
    $banner = get_frontUrlImg($data->image_id); 
    $banner_img = ($banner)? ' style=background-image:url("'.$banner.'")' : '';
@endphp
<div id="page-affiates" class="page">
    <div class="top-page"{{$banner_img}}>
        <div class="container"><h2 class="sec-title">{{$data->title}}</h2></div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row affiates">
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
                    @if($affiates->links())<div class="col-md-12 page-nav">{!!$affiates->links()!!}</div>@endif
                @endif
                <div class="col-md-12">
                    <p class="turnover-txt">** Turnover: The total investment amount of direct referrals.</p>
                    <div class="ref-info">Referral commission<span>10%</span></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection