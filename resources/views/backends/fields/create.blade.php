@extends('backends.templates.master')
@section('title','add field')
@section('content')
@php 
    $types = get_type();
    $pages = get_pages();
 @endphp
	<div id="create-field" class="container page">
		<div class="head">
			<a href="{{ route('customFieldAdmin') }}" class="back-icon"><i class="fa fa-angle-left" aria-hidden="true"></i> {{ _('All') }}</a>
			<h1 class="title">{{ _('Add field') }}</h1>
		</div>
		<div class="main">
			@include('notices.index')
			<form id="add-groupMeta" action="{{ route('createCustomFieldAdmin') }}" method="post" name="groupMeta" class="dev-form groupMeta add-post">
				{{ csrf_field() }}
				<div id="groupMeta-fields" class="row">
					<div id="frm-title" class="form-group col-md-8">
						<label for="title">{{ _('Name group') }}<small>(*)</small></label>
						<input type="text" name="title" class="form-control title" value="{{ old('title') }}" />
					</div>
					<div id="frm-object" class="form-group col-md-4">
						<label for="object">{{ _('Pages') }}<small>(*)</small></label>	
						<select class="form-control" name="page">
							@foreach($pages as $item)
								<option value="{{ $item->post_id }}" >{{ $item->title }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div id="fields" class="meta sortable" data-recores="0"></div>
				<a href="#" class="add-field">{{ _('Add field') }}</a>
				<div class="group-action">
					<button type="submit" class="btn btn-success">{{ _('Save') }}</button>
					<a href="{{ route('customFieldAdmin') }}" class="btn btn-secondary">{{ _('Cancel') }}</a>
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".sortable" ).sortable({			
				update: function(e, ui) {
					var count = 0;
					$(".sortable .ui-state-default").each(function(){
						count = count + 1;
						$(this).attr("data-position",count);
					});
				}
			});
			$(".add-field").click(function(){
				var recores = $(".sortable").attr("data-recores");
				var number = parseInt(recores) + 1;
				$(".sortable").attr("data-recores",number);
				var html = '<div id="item-'+number+'" class="item row ui-state-default new" data-meta="" data-position="'+number+'">';
				html = html + '<div class="form-group col-md-4">';
				html = html + '<label for="meta_name">Title</label>';
				html = html + '<input type="text" name="meta_title[]" class="form-control meta-title"/>';
				html = html + '</div>';
				html = html + '<div class="form-group col-md-3">';
				html = html + '<label for="meta_name">Name<small>(*)</small></label>';
				html = html + '<input type="text" name="meta_value[]" class="form-control meta-value"/>';
				html = html + '</div>';
				html = html + '<div class="form-group col-md-2">';
				html = html + '<label for="type">Type<small>(*)</small></label>';
				html = html + '<select class="form-control meta-type" name="meta_type">';
				html = html + '<option value="text">Text</option>';
				html = html + '<option value="textarea">Textarea</option>';
				html = html + '<option value="editor">Editor</option>';
				html = html + '<option value="image">Image</option>';
				html = html + '</select>';
				html = html + '</div>';
				html = html + '<div class="form-group col-md-2">';
				html = html + '<label for="column">Width<small>(*)</small></label>';
				html = html + '<select class="form-control meta-column" name="meta_column[]">';
				html = html + '<option value="2">20%</option>';
				html = html + '<option value="3">25%</option>';
				html = html + '<option value="4">33%</option>';
				html = html + '<option value="6">50%</option>';
				html = html + '<option value="12">100%</option>';
				html = html + '</select>';
				html = html + '</div>';
				html = html + '<div class="form-group col-md-1">';
				html = html + '<a href="#" class="btn btn-sm">Delete</a>';
				html = html + '</div';
				html = html + '</div';
				$("#fields").append(html);
				return false;
			});
		});
	</script>
@endsection