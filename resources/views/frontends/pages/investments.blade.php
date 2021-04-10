@extends('frontends.templates.master')
@section('title',$data->title)
@section('keywords',$data->meta_key)
@section('description',$data->meta_value)
@section('content')
@php 
    $plans = get_plans(16); 
    $banner = get_frontUrlImg($data->image_id); 
    $banner_img = ($banner)? ' style=background-image:url("'.$banner.'")' : '';
@endphp
<div id="page-plans" class="page">
    <div class="top-page"{{$banner_img}}>
        <div class="container"><h2 class="sec-title">{{$data->title}}</h2></div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row plans">
                @if($plans)
                    @foreach($plans as $plan)
                    <div class="col-md-3 block">
                        <div class="wrap">
                            <h3>{{$plan->title}}</h3>
                            <div class="thumb">{!!image($plan->image_id,253,151,$plan->title)!!}</div>
                            <div class="rate">
                                <span>{{$plan->daily_profit}}%</span>
                                <p>{{__('daily forever')}}</p>
                            </div>
                            <a href="#" class="caculator-btn"><i class="fas fa-calculator"></i>{{__('Calculate')}}</a>
                            <p class="min-deposit">Minimum Deposit: {{format_currency($plan->min_deposit)}}</p>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection