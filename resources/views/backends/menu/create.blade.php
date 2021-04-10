@extends('backends.templates.master')
@section('title','add menu')
@section('content')
<div id="add-menu-page" class="container page menu-page">
	<div class="head">
		<a href="{{route('menuAdmin')}}" class="back-icon"><i class="fa fa-angle-left" aria-hidden="true"></i> Menu</a>
		<h1 class="title">{{__('create menu')}}</h1>		
	</div>
	<div class="main">
		<form id="create-menu" action="{{route('createMenuAdmin')}}" class="frm-menu dev-form" method="POST" name="createMenu" role="form" data-search="{{ route('searchMenuAdmin') }}">
		{!!csrf_field()!!}
		<div class="row">				
			<div class="col-md-12 left-box">			
				<section class="box-wrap box-title">
					<h2 class="title">{{__('Title')}}</h2>
					<input type="text" name="title" class="mn-title frm-input">
				</section>
				<section class="box-wrap mn-link">
					<h2 class="title">{{__('Link')}}</h2>
					<div class="list">
						<p class="empty">{{__('No links')}}.</p>
						<ul class="sortable" data-recores="0">							
						</ul>
					</div>
					<button class="btn-add"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('Add record')}}</button>
				</section>
			</div>	
		</div>
		<div class="group-action">
            <button type="submit" name="submit" class="btn btn-success">{{__('Okay')}}</button>
			<a href="{{route('menuAdmin')}}" class="btn btn-secondary">{{__('Cancle')}}</a>
		</div>
	</form>
</div>
</div>
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
			$("#add-menu-page .left-box .list .empty").remove();
			var recores = $(".mn-link .list .sortable").attr("data-recores");
			number = parseInt(recores) + 1;
			$(this).parents(".box-wrap").find(".sortable").attr("data-recores",number);
			var html = '<li id="'+number+'" class="ui-state-default item-'+number+' new" data-position="'+number+'">';
					html = html + '<div class="link-title">';
					html = html + '<input type="text" name="links[]" placeholder="Name link" class="frm-input" /><i class="fa fa-trash" aria-hidden="true"></i>';
					html = html + '</div>';
					html = html + '<div class="row link-content">';
					html = html + '{!!menuType()!!}';
					html = html + '<div class="dropdown show type-value col-md-5"></div>';
					html = html + '<div class="link-type col-md-2"></div>';
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