jQuery(document).ready(function($){
    var btn = $('.back-to-top');
    $(window).scroll(function() {
      if ($(window).scrollTop() > 300) {
        btn.addClass('show');
      } else {
        btn.removeClass('show');
      }
    });
    btn.on('click', function(e) {
      e.preventDefault();
      $('html, body').animate({scrollTop:0}, '300');
    });
	$(".link-chat").on("click", function(){
		$(".fb_reset").fadeIn();
		FB.CustomerChat.showDialog();
		return false;
    });
    $(".link-contact").on("click", function(){
    	$("#modal-contact").modal("hide");
		$("#popupModal").modal("show");
		return false;
    });
});