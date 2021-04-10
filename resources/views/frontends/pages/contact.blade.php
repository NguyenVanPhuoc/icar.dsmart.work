@extends('frontends.templates.master')
@section('title',$data->title)
@section('keywords',$data->meta_key)
@section('description',$data->meta_value)
@section('content')
@php
    $banner = get_frontUrlImg($data->image_id); 
    $banner_img = ($banner)? ' style=background-image:url("'.$banner.'")' : '';
@endphp
<div id="page-contact" class="page">
    <div class="top-page"{{$banner_img}}>
        <div class="container"><h2 class="sec-title">{{$data->title}}</h2></div>
    </div>
    <div class="content">
        <div class="container">
            <div class="hotline">
                <div class="row">
                    <div class="col-md-4 phone">
                        <div class="wrap">
                            <div class="icon"><i aria-hidden="true" class="fas fa-map-marked-alt"></i></div>
                            {!!get_fieldContent('contact_address')!!}
                        </div>
                    </div>
                    <div class="col-md-4 work-timne">
                        <div class="wrap">
                            <div class="icon"><i aria-hidden="true" class="fas fa-phone-alt"></i></div>
                            {!!get_fieldContent('contact_hotline')!!}
                        </div>
                    </div>
                    <div class="col-md-4 email">
                        <div class="wrap">
                            <div class="icon"><i aria-hidden="true" class="fas fa-envelope"></i></div>
                            {!!get_fieldContent('contact_email')!!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row frm-info">
                <div class="col-md-6 frm-contact">
                    @include('notices.index')
                    <form id="form-contact" action="{{route('sendContact')}}" method="POST" name="contact" class="dev-form" data-toggle="validator" role="form">
                        {{ csrf_field()  }}
                        <div id="frm-fullname" class="form-group">
                            <label for="fullname" class="control-label">{{ __('Name') }}<small>(*)</small></label>
                            <input type="text" name="fullname" id="fullname" class="form-control" data-error="{{ __('enter your name')}}" required>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div id="frm-email" class="form-group">
                            <label for="email" class="control-label">{{ __('Email') }}<small>(*)</small></label>
                            <input type="email" name="email" id="email" class="form-control" data-error="{{ __('enter your email')}}" required>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div id="frm-phone" class="form-group">
                            <label for="phone" class="control-label">{{ __('Phone') }}</label>
                            <input type="text" name="phone" id="phone" class="form-control" >
                        </div>
                        <div id="frm-message" class="form-group">
                            <label for="message" class="control-label">{{ __('Message') }}<small>(*)</small></label>
                            <textarea name="message" id="message" class="form-control" rows="12" data-error="{{ __('enter your email')}}" required></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div id="frm-submit" class="form-group text-right"><button type="submit" class="btn btn-primary">{{ _('Send') }}</button></div>
                    </form>
                </div>
                <div class="col-md-6 conten-contact">{!!$data->content!!}</div>
            </div>
        </div>
    </div>
</div>
@endsection