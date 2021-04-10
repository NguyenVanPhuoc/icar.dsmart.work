@extends('backends.templates.master')
@section('title','edit field')
@section('content')
@php 
    $types = get_type();
    $pages = get_pages();
    $field_type = get_fieldType();
    $field_column = get_fieldColumn();
 @endphp
	<div id="create-field" class="container page">
		<div class="head">
			<a href="{{ route('customFieldAdmin') }}" class="back-icon"><i class="fa fa-angle-left" aria-hidden="true"></i> {{ _('All') }}</a>
			<h1 class="title">{{ _('Edit field') }}</h1>
		</div>
		<div class="main">
			@include('notices.index')
			<form id="edit-groupMeta" action="{{ route('editCustomFieldAdmin',['id'=>$group->id]) }}" method="post" name="groupMeta" class="dev-form groupMeta">
				{{ csrf_field() }}
				<div id="groupMeta-fields" class="row">
					<div id="frm-title" class="form-group col-md-8">
						<label for="title">{{ _('Name group') }}<small>(*)</small></label>
						<input type="text" name="title" class="form-control title" value="{{ $group->title }}" />
					</div>
					<div id="frm-object" class="form-group col-md-4">
						<label for="object">{{ _('Pages') }}<small>(*)</small></label>	
						<select class="form-control" name="page">
							@foreach($pages as $item) @php $selected = ($group->post_id == $item->post_id)? ' selected':''; @endphp
								<option value="{{ $item->post_id }}"{{$selected}}>{{ $item->title }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div id="fields" class="meta sortable" data-recores="{{count($fields)}}">
                    @if(count($fields)>0) @php $count = 0; @endphp
                        @foreach($fields as $item) @php $count++; @endphp
                        <div id="item-{{$count}}" class="item row ui-state-default old" data-meta="{{$item->id}}" data-position="{{$count}}">
                            <div class="form-group col-md-4"><label for="meta_name">{{__('Title')}}</label><input type="text" name="meta_title[]" class="form-control meta-title" value="{{$item->title}}"></div>
                            <div class="form-group col-md-3"><label for="meta_name">{{__('Name')}}<small>(*)</small></label><input type="text" name="meta_value[]" class="form-control meta-value" value="{{$item->value}}"></div>
                            <div class="form-group col-md-2">
                                <label for="type">Type<small>(*)</small></label>
                                <select class="form-control meta-type" name="meta_type">
                                    @foreach($field_type as $key=>$value) @php $selected = ($key==$item->type)? ' selected':''; @endphp
                                        <option value="{{$key}}"{{$selected}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="column">Width<small>(*)</small></label>
                                <select class="form-control meta-column" name="meta_column[]">
                                    @foreach($field_column as $key=>$value) @php $selected = ($key==$item->width)? ' selected':''; @endphp
                                        <option value="{{$key}}"{{$selected}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-1"><a href="#" class="btn btn-sm">{{__('Delete')}}</a></div>
                        </div>
                        @endforeach
                    @endif
                </div>
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
				html = html + '<option value="2">2 column</option>';
				html = html + '<option value="3">3 column</option>';
				html = html + '<option value="4">4 column</option>';
				html = html + '<option value="5">5 column</option>';
				html = html + '<option value="6">6 column</option>';
				html = html + '<option value="8">8 column</option>';
				html = html + '<option value="9">9 column</option>';
				html = html + '<option value="10">10 column</option>';
				html = html + '<option value="12">12 column</option>';
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