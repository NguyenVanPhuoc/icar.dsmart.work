(function($) {
    //remve record
    var del_items = new Array();
    $('.groupMeta').on( "click", "#fields a.btn", function() {
        var recores = $(this).parents(".sortable").attr("data-recores");
        var meta_id = $(this).parents(".item").attr("data-meta");
        if(meta_id!=""){
            del_items.push(meta_id);
        }
        $(this).parents(".sortable").attr("data-recores", parseInt(recores) - 1)
        $(this).parents(".item").remove();
        return false;
    });
    
    //add group meta
    $(".groupMeta .group-action .btn-success").click(function(){
        var _token = $(".groupMeta input[name='_token']").val();
        var _link = $(".groupMeta").attr('action');
        var title = $("#frm-title input").val();
        var post_id = $("#frm-object select").val();
        var metas = new Array();
        var metas_old = new Array();
        var count = 0;
        var count_old = 0;
        var errors = new Array();
        $("#fields .item").each(function(){
            var meta_value = $(this).find(".meta-value").val();
            var meta_id = $(this).attr("data-meta");
            if(meta_id==""){
                if( meta_value != ""){
                    metas[count] = {
                        'title' : $(this).find(".meta-title").val(),
                        'value' : $(this).find(".meta-value").val(),
                        'type' : $(this).find(".meta-type").val(),
                        'width' : $(this).find(".meta-column").val(),
                        'position' : $(this).attr("data-position")
                    }
                    count += 1;
                }else{
                    errors.push("One / more rows are empty!");
                }
            }else{
                if( meta_value != ""){
                    metas_old[count_old] = {
                        'id' : meta_id,
                        'title' : $(this).find(".meta-title").val(),
                        'value' : $(this).find(".meta-value").val(),
                        'type' : $(this).find(".meta-type").val(),
                        'width' : $(this).find(".meta-column").val(),
                        'position' : $(this).attr("data-position")
                    }
                    count_old += 1;
                }else{
                    errors.push("One / more rows are empty!");
                }
            }
        }); 
        if(title=="") errors.push("Please enter field title");
        var i;
        var html = "<ul>";
        for(i = 0; i < errors.length; i++){
            if(errors[i] != ""){
                html +='<li>'+errors[i]+'</li>';
                error_count += 1;
            }
        }     
        if(errors.length>0){
            html += "</ul>";
            new PNotify({
                title: 'error ('+errors.length+')',
                text: html,
                hide: true,
                delay: 6000,
            });
        }else{ console.log(111);
            $.ajax({
                type:'POST',
                url: _link,
                cache: false,
                data:{
                    '_token': _token,
                    'title': title,
                    'post_id': post_id,
                    'metas': JSON.stringify(metas),
                    'metas_old': JSON.stringify(metas_old),
                    'del_items': JSON.stringify(del_items)
                },
                success:function(data){
                    location.reload();
                }
            });
        }
        return false;
    });
})(jQuery);