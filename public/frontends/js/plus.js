jQuery(document).ready(function($){
	// $('input.only_number').keyup(function(event) {
	//     if(event.which >= 37 && event.which <= 40) return;
	//     $(this).val(function(index, value) {
	//         return value
	//         .replace(/\D/g, "");
	//     });
	// });

	$('.choose-deposit').on('click', function(e) {
		e.preventDefault();
		var min = parseFloat($(this).attr('data-min'));
		var profit = parseFloat($(this).attr('data-profit'));
		var title = $(this).closest('.item-plan').find('.plan-title').text();
		$('#chooseDeposit .sec-title').text(title);
		$('#chooseDeposit input[name="deposit_amount"]').val(min.toString().replace('.',','));
		$('#chooseDeposit #daily_profit').val((min*profit/100).toString().replace('.',','));
		$('#chooseDeposit #weekly_profit').val((min*7*profit/100).toString().replace('.',','));
		$('#chooseDeposit #monthly_profit').val((min*30*profit/100).toString().replace('.',','));
		$('#chooseDeposit').modal('show');
	});

	$('#chooseDeposit input[name="deposit_amount"]').on('input', function(e) {
		// clearTimeout(this.delay);
		// this.delay = setTimeout(function(){
			e.preventDefault();
			var select = '';
			var amount = parseFloat($(this).inputmask('unmaskedvalue'));		
			$('#make-deposit .choose-deposit').each(function (index) {
				if(amount >= parseFloat($(this).attr('data-min')) && (amount < parseFloat($(this).attr('data-max')) || $(this).attr('data-max') == '')) {
					select = $(this).closest('.item-plan');
					return false;
				}
			});
			if(select != '') {
				var title = select.find('.plan-title').text();
				var profit = parseFloat(select.find('.choose-deposit').attr('data-profit'));
				$('#chooseDeposit .sec-title').text(title);
				$('#chooseDeposit #daily_profit').val((amount*profit/100).toString().replace('.',','));
				$('#chooseDeposit #weekly_profit').val((amount*7*profit/100).toString().replace('.',','));
				$('#chooseDeposit #monthly_profit').val((amount*30*profit/100).toString().replace('.',','));
			}
			if(amount < parseFloat($(this).attr('min'))) {
				$('#chooseDeposit button[type="submit"]').attr('disabled', true);
			}else{
				$('#chooseDeposit button[type="submit"]').attr('disabled', false);
			}
		// }.bind(this), 500);
	});

	if($('.currency-format').length > 0) {
		var currency = $('.currency-format').closest('form').attr('data-currency');
		$(".currency-format").inputmask("decimal",{
         	radixPoint:",", 
         	groupSeparator: ".", 
         	digits: 2,
         	autoGroup: true,
         	prefix: currency,
         	rightAlign: false,
         	removeMaskOnSubmit: true
     	});
	}
}) 