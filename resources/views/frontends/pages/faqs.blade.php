@extends('frontends.templates.master')
@section('title',$data->title)
@section('keywords',$data->meta_key)
@section('description',$data->meta_value)
@section('content')
@php
    $faqs = get_faqs(15); $count = 0;
    $banner = get_frontUrlImg($data->image_id); 
    $banner_img = ($banner)? ' style=background-image:url("'.$banner.'")' : '';
@endphp
<div id="page-faqs" class="page">
    <div class="top-page"{{$banner_img}}>
        <div class="container"><h2 class="sec-title">{{$data->title}}</h2></div>
    </div>
    <div class="content">
        <div class="container">
            @if($faqs)
            <div id="accordion">
                @foreach($faqs as $item) @php $count++; $show = ($count==1)? ' show':''; @endphp
                <div class="card">
                    <div class="card-header" id="{{$item->slug}}">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-{{$item->id}}" aria-expanded="true" aria-controls="collapse{{$item->id}}">{{$item->title}}</button>
                        </h5>
                    </div>
                    <div id="collapse-{{$item->id}}" class="collapse{{$show}}" aria-labelledby="{{$item->slug}}" data-parent="#accordion">
                        <div class="card-body">{!!$item->content!!}</div>
                    </div>
                </div>
                @endforeach
            </div>
            @if($faqs->links())<div class="page-nav">{!!$faqs->links()!!}</div>@endif
            @endif
        </div>
    </div>
</div>
@endsection