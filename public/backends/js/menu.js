(function($) {
    //append html
    $(".menu-page").on("click", ".link-content .type .list-item a", function() {
        var a_href = $(this).attr("href");
			var a_txt = $(this).text();
			var count = $(this).parents(".ui-state-default").attr("id");
			$(this).parent(".list-item").find("a").removeClass("active");
			$(this).addClass("active");			
			$(this).parents(".type").find(".dropdown-toggle").text($(this).text());
            $(this).parents(".dropdown-menu").removeClass("show");
            $('.sortable .item-'+count+' .link-content .type-value').attr("data-type",a_href);
			$('.sortable .item-'+count+' .link-content .type-value').html('<a class="dropdown-toggle" href="'+a_href+'" role="button" id="result-type-'+count+'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">choose '+a_txt+'</a>');
			if(a_href == "#link"){
				$html = '<input name="custome_link" type="text" class="frm-input custom-link"/>';
				$('.sortable .item-'+count+' .link-content .type-value').html($html);
            }
            $('.sortable .item-'+count+' .link-content .link-type').html('<div class="checkbox checkbox-success"><input id="target-'+count+'" type="checkbox" name="target"><label for="target-'+count+'">_blank</label></div>');
			return false;

    });
    //show search form
    $(".menu-page").on('click','.link-content .type-value .dropdown-toggle',function(){
        var number = $(this).parents(".ui-state-default").attr("id");
        $(".sortable .item-"+number).find('.type-value .dropdown-menu').remove();
        var html = '<div class="dropdown-menu" aria-labelledby="result-type-'+number+'">';
                html +='<div class="search-input">';
                    html +='<i class="fa fa-search" aria-hidden="true"></i>';
                    html +='<input type="text" class="frm-input" placeholder="key word"/>';
                html +='</div>';
                html +='<div class="list-item"></div>';
            html +='</div>';
        $(".sortable .item-"+number).find('.type-value').append(html);
    }); 
    //key search
    $(".menu-page").on('keyup','.link-content .dropdown-menu .search-input .frm-input',function(){
        var type = $(this).parents(".type-value").find(".dropdown-toggle").attr("href");
        var _token = $(".frm-menu input[name='_token']").val();
        var number = $(this).parents(".ui-state-default").attr("id");
        var _url = $(".menu-page .frm-menu").attr("data-search");
        $.ajax({
                type:'POST',            
                url:_url,
                cache: false,
                data:{
                    '_token': _token,
                    'type': type,
                    'title': $(this).val()
                },
        }).done(function(data) {
                $(".sortable .item-"+number).find('.type-value .dropdown-menu .list-item').html(data);
        });
    });
    //apply value & close popup
    $(".menu-page").on('click','.link-content .type-value .list-item a',function(){
        $(this).parents(".type-value").find(".dropdown-toggle").text($(this).text());
        $(this).parents(".type-value").find(".dropdown-toggle").attr('data-value',$(this).attr("data-value"));
        $(this).parents(".dropdown-menu").removeClass("show");			
        return false;
    });
    //delete record    
    $(".sortable").on('click','i.fa-trash',function(){						
        $(this).parents(".ui-state-default").remove();
        var count = 0;
        $(".sortable .ui-state-default").each(function(){
            count = count + 1;
            $(this).attr("data-position",count);
        });
    });
    //create memu
    $("#create-menu").on('click','.group-action .btn-success',function(){
        var _token = $(".frm-menu input[name='_token']").val();
        var _url =  $(".frm-menu").attr("action");
        var title = $(".frm-menu .mn-title").val();
        var new_metas = new Array();
        var new_count = 0;
        var errors = new Array();
        var error_count = 0;
        
        $("#create-menu .list .sortable .ui-state-default").each(function(){
            var error = $(this).find(".type-value .dropdown-toggle").attr("data-value");
            var type = $(this).find(".type-value").attr("data-type");
            var title_value, value, blank = '';
            var id = $(this).attr("id");
            if(type!="#link"){
                title_value = $(this).find(".type-value .dropdown-toggle").text();
                value = $(this).find(".type-value .dropdown-toggle").attr("data-value");
            }else{
                title_value = $(this).find(".type-value .frm-input").val();
                value = $(this).find(".type-value .frm-input").val();
            }
            if( error === undefined && type!="#link"){
                errors[error_count] = $(this).attr("id");
                error_count = error_count + 1;
            }
            new_metas[new_count] = {
                'title' : $(this).find(".link-title .frm-input").val(),
                'title_value' : title_value,
                'type' : type,
                'value' : value,
                'position' : $(this).attr("data-position"),
                'target' : $('#target-'+id).is(":checked")
            }
            new_count = new_count + 1;
        });

        var new_metas= JSON.stringify(new_metas);				
        if(errors.length > 0){
            new PNotify({
                title: 'errors',
                text: 'one or more links haven not value.',
                hide: true,
                delay: 2000,
            });
        }else{
           $.ajax({
                type:'POST',            
                url:_url,
                cache: false,
                data:{
                    '_token': _token,
                    'title':title,
                    'metas': new_metas
                },
           }).done(function(data) {
                   new PNotify({
                    title: 'success',
                    text: 'menu is created.',
                    type: 'success',
                    hide: true,
                    delay: 2000,
                });
                location.reload();
           });
       }
       return false;
    });
    //update menu
    var delItems = new Array();
    $(".sortable").on('click','i.fa-trash',function(){
        var item_id = $(this).parents(".ui-state-default").find(".type-value").attr("data-meta");
        delItems.push(item_id);
        $(this).parents(".ui-state-default").remove();
        var count = 0;
        $(".sortable .ui-state-default").each(function(){
            count = count + 1;
            $(this).attr("data-position",count);
        });
    });
    $("#edit-menu").on('click','.group-action button',function(){
        var _token = $(".frm-menu input[name='_token']").val();
        var _url =  $(".frm-menu").attr("action");
        var title = $(".frm-menu .mn-title").val();			
        var new_metas = new Array();
        var old_metas = new Array();
        var old_count = 0;
        var new_count = 0;
        var errors = new Array();
        var error_count = 0;			
        $(".menu-page .list .sortable .ui-state-default").each(function(){
            var error = $(this).find(".type-value .dropdown-toggle").attr("data-value");
            var type = $(this).find(".type-value").attr("data-type");
            var title_value, value, blank = '';
            var id = $(this).attr("id");
            if(type!="#link"){
                title_value = $(this).find(".type-value .dropdown-toggle").text();
                value = $(this).find(".type-value .dropdown-toggle").attr("data-value");
            }else{
                title_value = $(this).find(".type-value .frm-input").val();
                value = $(this).find(".type-value .frm-input").val();
            }
            if( error === undefined && type!="#link"){
                errors[error_count] = $(this).attr("id");
                error_count = error_count + 1;
            }
            if($(this).hasClass('old')){
                old_metas[old_count] = {
                    'meta_id' : $(this).find(".type-value").attr("data-meta"),
                    'title' : $(this).find(".link-title .frm-input").val(),
                    'title_value' : title_value,
                    'type' : type,
                    'value' : value,
                    'position' : $(this).attr("data-position"),
                    'target' : $('#target-'+id).is(":checked")
                }
                old_count = old_count + 1;
            }else{
                new_metas[new_count] = {
                    'title' : $(this).find(".link-title .frm-input").val(),
                    'title_value' : title_value,
                    'type' : type,
                    'value' : value,
                    'position' : $(this).attr("data-position"),
                    'target' : $('#target-'+id).is(":checked")
                }
                new_count = new_count + 1;
            }
        });	//		console.log(delItems);
        var new_metas= JSON.stringify(new_metas);
        var old_metas= JSON.stringify(old_metas);			
        if(errors.length > 0){
            new PNotify({
                title: 'errors',
                text: 'one or more links haven not value.',
                hide: true,
                delay: 2000,
            });
        }else{
            $.ajax({
                type:'POST',            
                url:_url,
                cache: false,
                data:{
                    '_token': _token,					
                    'title':title,
                    'new_metas': new_metas,
                    'old_metas': old_metas,
                    'delItems': JSON.stringify(delItems)
                },
            }).done(function(data) {
                new PNotify({
                    title: 'success',
                    text: 'menu is updated.',
                    type: 'success',
                    hide: true,
                    delay: 2000,
                });
                location.reload();
            });
        }
        return false;
    });
})(jQuery);