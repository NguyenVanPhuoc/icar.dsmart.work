@extends('backends.templates.master')
@section('title',__('Add file'))
@section('content')
<?php $mediaCats = get_mediaCategoreis();?>
<div id="create-media" class="content-wrapper medias">
	<div class="head">
		<a href="{{route('mediaAdmin')}}" class="back-icon"><i class="fa fa-angle-left" aria-hidden="true"></i>{{ __('All') }}</a>
		<h1 class="title">{{ __('Add file') }}</h1>
	</div>
	<div class="main">
		<div id="dropzone">	
			<div class="row">
				<div class="col-md-3 sidebar clearfix">
					<section id="sb-mediaCat" class="box-wrap">
						<h2 class="title">{{ __('Categories') }}</h2>
						@if(isset($mediaCats))
						<div class="desc list">
							@foreach($mediaCats as $item)
							<div class="checkbox checkbox-success item">
								<input id="item-{{$item->id}}" type="checkbox" name="mediaCats[]" value="{{$item->id}}">
								<label for="item-{{$item->id}}">{{$item->title}}</label>
							</div>
							@endforeach
						</div>
						@endif
					</section>
				</div>
				<div class="col-md-9 content clearfix">
					<form action="#" class="dropzone" id="frmTarget">
						{!! csrf_field() !!}
						<input type="hidden" name="category" id="category" value="">
						<input type="hidden" name="image_of" value="">
						<div class="dz-message needsclick">{{ _('choose files') }}</div>
					</form>
					<div class="group-action text-right mt-2">
						<button id="submit" type="submit" name="submit" class="btn btn-success">{{ __('Save') }}</button>
						<a href="{{route('mediaAdmin')}}" class="btn btn-secondary">{{ __('Cancel') }}</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	
</script>
@stop