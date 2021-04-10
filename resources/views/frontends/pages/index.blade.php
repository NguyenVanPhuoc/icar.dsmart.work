@extends('frontends.templates.master')
@section('title',$data->title)
@section('keywords',$data->meta_key)
@section('description',$data->meta_value)
@section('content')
@php 
    $banner = get_frontUrlImg($data->image_id); 
    $banner_img = ($banner)? ' style=background-image:url("'.$banner.'")' : '';
@endphp
<div class="page">
    <div class="top-page"{{$banner_img}}>
        <div class="container"><h2 class="sec-title">{{$data->title}}</h2></div>
    </div>
    <div class="content">
        <div class="container">{!!$data->content!!}</div>
    </div>
</div>
@endsection