@extends('backends.templates.master')
@section('title','add media category')
@section('content')
<div id="edit-mediaCat" class="container page medias">
	<div class="head">
		<a href="{{route('mediaCatAdmin')}}" class="back-icon"><i class="fa fa-angle-left" aria-hidden="true"></i> Danh mục</a>
		<h1 class="title">{{__('Add new')}}</h1>		
	</div>
	<div class="main">
		@include('notices.index')
		<form action="{{route('createMediaCatAdmin')}}" class="frm-menu dev-form" method="POST" name="createMediaCat" role="form">
			{!!csrf_field()!!}
			<div id="frm-title" class="form-group">
				<label for="title">{{__('Title')}}<small class="required">(*)</small></label>
				<input type="text" name="title" class="form-control" class="frm-input">
			</div>
			<div class="group-action">
				<button type="submit" name="submit" class="btn btn-success">{{__('Okay')}}</button>
				<a href="{{route('mediaCatAdmin')}}" class="btn btn-secondary">{{__('Cancel')}}</a>
			</div>
		</form>				
	</div>
</div>
@endsection