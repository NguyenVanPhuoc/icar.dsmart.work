@extends('backends.templates.master')
@section('title','edit menu')
@section('content')
@php $types = get_type();@endphp
<div id="edit-menu-page" class="container page menu-page">
	<div class="head">
		<a href="{{route('menuAdmin')}}" class="back-icon"><i class="fa fa-angle-left" aria-hidden="true"></i> Menu</a>
		<h1 class="title">{{$menu->title}}</h1>		
	</div>
	<div class="main">
		<form id="edit-menu" action="{{route('editMenuAdmin',['id'=>$menu->id])}}" class="frm-menu dev-form" method="POST" name="edit_menu" role="form"  data-search="{{ route('searchMenuAdmin') }}">
		{!!csrf_field()!!}
		<div class="row">
			<div class="col-md-12 left-box clearfix">
				<section class="box-wrap box-title">
					<h2 class="title">Title</h2>
					<input type="text" name="title" class="mn-title frm-input" value="{{$menu->title}}">
				</section>
				<section class="box-wrap mn-link">
					<h2 class="title">{{__('Link')}}</h2>
					<div class="list">
						@if(empty(getSubMenu($menu->id)))
							<p class="empty">{{__('No items')}}.</p>	
						@else
						<?php $count = 0;?>
						<?php $metas = getSubMenu($menu->id);?>
							<ul class="sortable" data-recores="{{count($metas)}}">
								@foreach($metas as $meta)<?php $count++;?>
								<li id="{{$count}}" class="ui-state-default item-{{$count}} old" data-position="{{$count}}">
									<div class="link-title">
										<input type="text" name="links[]" placeholder="{{__('enter name')}}" value="{{$meta->title_custom}}" class="frm-input" />
										<i class="fa fa-trash" aria-hidden="true"></i>
									</div>
									<div class="row link-content">
										{!!menuType($meta->type)!!}
										<div class="dropdown show type-value col-md-5 col-sm-5 col-xs-5" data-type="#{{$meta->type}}" data-meta="{{$meta->id}}">
											@if($meta->type!="link")
												<a class="dropdown-toggle" href="#{{$meta->type}}" role="button" id="result-type-{{$count}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-value="{{$meta->post_id}}" data-meta="{{$meta->id}}">{{$meta->title_default}}</a>
												<div class="dropdown-menu" aria-labelledby="result-type-{{$count}}">
													<div class="search-input">
														<i class="fa fa-search" aria-hidden="true"></i>
														<input type="text" class="frm-input" placeholder="key word"/>
													</div>
													<div class="list-item"></div>
												</div>
											@else
												<input name="custome_link" type="text" class="frm-input custom-link" value="{{$meta->title_default}}">
											@endif
										</div>
										<div class="col-md-2 col-sm-2">
											<div class="checkbox checkbox-success">
												<input id="target-{{$meta->id}}" type="checkbox" name="target"<?php if($meta->target!="_self") echo 'checked';?>>
												<label for="target-{{$meta->id}}">_blank</label>
											</div>
										</div>
									</div>
								</li>
								@endforeach
							</ul>
						@endif
					</div>
					<button class="btn-add"><i class="fa fa-plus-circle" aria-hidden="true"></i>{{__('add record')}}</button>
				</section>
			</div>			
		</div>
		<div class="group-action">
			<a href="{{route('deleteMenuAdmin',['id'=>$menu->id])}}" class="btn btn-danger float-left" data-toggle="modal" data-target="#sideModal" data-direct="modal-normal">{{__('delete')}}</a>
			<button type="submit" name="submit" class="btn btn-success">{{__('save')}}</button>
			<a href="{{route('menuAdmin')}}" class="btn btn-secondary">{{__('cancel')}}</a>
		</div>
	</form>			
</div>
</div>
@include('modals.modal_delete')
<script type="text/javascript">	
	$(function() {		
		$(".sortable" ).sortable({
		    update: function(e, ui) {
		        var count = 0;
		        $(".sortable .ui-state-default").each(function(){
		        	count = count + 1;
		        	$(this).attr("data-position",count);
		        });
		    }
		});	
		//add recore		
		$(".menu-page").on('click','.btn-add',function(){
			$("#menu-page .left-box .list .empty").remove();
			var recores = $(".mn-link .list .sortable").attr("data-recores");
			number = parseInt(recores) + 1;
			$(this).parents(".box-wrap").find(".sortable").attr("data-recores",number);
			var html = '<li id="'+number+'" class="ui-state-default item-'+number+' new" data-position="'+number+'">';
					html = html + '<div class="link-title">';
					html = html + '<input type="text" name="links[]" placeholder="Nhập tên liên kết" class="frm-input" /><i class="fa fa-trash" aria-hidden="true"></i>';
					html = html + '</div>';
					html = html + '<div class="row link-content">';
					html = html + '{!!menuType()!!}';
					html = html + '<div class="dropdown show type-value col-md-5 col-sm-5 col-xs-5"></div>';					
					html +='<div class="col-md-2 col-sm-2">';
					html +='<div class="checkbox checkbox-success">';
					html +='<input id="target-'+number+'" type="checkbox" name="target">';
					html +='<label for="target-'+number+'">_blank</label>';
					html +='</div>';
					html +='</div>';
					html = html + '</div>';
				html = html + '</li';
			$(".list .sortable .item-"+number).find(".link-content .type .dropdown-toggle").attr("id","type-"+number);
			$(".list .sortable .item-"+number).find(".link-content .type .dropdown-menu").attr("aria-labelledby","type-"+number);
			$(".list .sortable").append(html);
			return false;
		});
	});	
</script>
@stop