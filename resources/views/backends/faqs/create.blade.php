@extends('backends.templates.master')
@section('title','add faqs')
@section('content')
@php $status = get_statusPost(); @endphp
<div id="create-store" class="content-wrapper stores">
    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="head">
                <a href="{{route('faqsAdmin')}}" class="back-icon"><i class="fas fa-angle-left" aria-hidden="true"></i>{{__('Come back')}}</a>
                <h1 class="title">{{__('New faqs')}}</h1>
            </div>
            <div class="main">
                @include('notices.index')
                <form action="{{ route('createFaqsAdmin') }}" name="createFaqs" class="dev-form" method="POST" data-toggle="validator" role="form">
                    @csrf
                    <div class="row">
                        <div class="col-md-9 content">
                            <div id="frm-title" class="form-group">
                                <label for="title" class="control-label">{{ __('Title') }}<small>(*)</small></label>
                                <input type="text" name="title" value="{{Request::old('title')}}" class="form-control" data-error="{{ __('Enter title')}}" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div id="frm-content" class="form-group">
                                <label for="content" class="control-label">{{ __('Content') }}</label>
                                <textarea name="content" rows="10"  class="form-control editor">{{Request::old('content')}}</textarea>
                            </div>
                            <div class="group-action">
                                <button type="submit" name="submit" class="btn btn-success">{{__('Okay')}}</button>
                                <a href="{{route('faqsAdmin')}}" class="btn btn-secondary">{{__('Cancle')}}</a>	
                            </div>
                        </div>
                        <div class="col-md-3 sb-sidebar">
                            @if(count($status)>0)
                            <aside id="sb-status" class="card card-outline card-info">
                                <div class="card-header">
                                    <h3 class="card-title">{{__('Trạng thái')}}</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <select class="form-control select2bs4" name="status">
                                        @foreach($status as $key => $value) 
                                        <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </aside>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  @include('backends.media.library')
@endsection