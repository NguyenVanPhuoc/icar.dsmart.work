(function($) {
	'use strict';
	//show slug
	$(".slug").on('click','.btn-slug',function(){
		$(".slug").addClass("sl-active");
		$(this).addClass("sl-save");
		$(".slug .sl-save").text('save');
		$(".slug .sl-save").after('<a href="#" class="sl-cancle">cancle</a>');
		$(".slug input").prop("readonly",false);
		$(this).removeClass('btn-slug');
		return false;
	});
	//change slug
	$(".slug").on('click','.sl-cancle',function(){
		var slug = $(".slug input").attr("data-slug");
		$(".slug input").val(slug);
		$(".slug input").prop("readonly",true);
		$(".slug button").addClass('btn-slug');
		$(".slug button").removeClass('sl-save');
		$(".slug button").text('edit');
		$(".slug").removeClass('sl-active');
		$(this).remove();
		return false;
	});
	//close slug
	$(".dev-form").on('click','.slug .sl-save',function(){
		var _token = $(".dev-form input[name='_token']").val();
		var slug = $(".slug input").val();
		var link = $(".slug input").attr('data-action');
		if(slug == ""){
			new PNotify({
			    title: 'Error',
			    text: 'Slug not empty!',
			    hide: true,
			    delay: 2000,
			});
		}else{
			$.ajax({
				type:'POST',
				url:link,
				cache: false,
				data:{
					'_token': _token,
					'slug': slug
				},
				success:function(data){
					if(data!='error'){
						$(".slug .sl-cancle").remove();
						$(".slug input").val(data);
						$(".slug input").attr('data-slug',data);
						$(".slug button").addClass('btn-slug');
						$(".slug button").removeClass('sl-save');
						$(".slug button").text('edit');
						$(".slug").removeClass('sl-active');
						$(".slug input").prop("readonly",true);
					}
				}
			});
		}
		return false;
	});
})(jQuery);