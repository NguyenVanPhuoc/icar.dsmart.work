@extends('backends.templates.master')
@section('title','edit media category')
@section('content')
<div id="edit-mediaCat" class="container page medias">
	<div class="head">
		<a href="{{route('mediaCatAdmin')}}" class="back-icon"><i class="fa fa-angle-left" aria-hidden="true"></i> Danh mục</a>
		<h1 class="title">{{$mediaCat->title}}</h1>		
	</div>
	<div class="main">
		@include('notices.index')
		<form action="{{route('updateMediaCatAdmin',['id'=>$mediaCat->id])}}" class="frm-menu dev-form" method="POST" name="editMediaCat" role="form">
			{!!csrf_field()!!}
			<div id="frm-title" class="form-group">
				<label for="title">{{__('Title')}}<small class="required">(*)</small></label>
				<input type="text" name="title" class="form-control" class="frm-input" value="{{$mediaCat->title}}">
			</div>
			<div class="group-action">
				<a href="{{route('deleteMediaCatAdmin',['id'=>$mediaCat->id])}}" class="btn btn-danger float-left" data-toggle="modal" data-target="#sideModal" data-direct="modal-normal">{{__('Delete')}}</a>
				<button type="submit" name="submit" class="btn btn-success">{{__('Save')}}</button>
				<a href="{{route('mediaCatAdmin')}}" class="btn btn-secondary">{{__('Cancel')}}</a>
			</div>
		</form>				
	</div>
</div>
@include('modals.modal_delete')
@endsection