<div class="item-plan">
	<div class="wrap-thumb">
	    <h3 class="plan-title">{{ $plan->title }}</h3>
	    <div class="thumb">{!! image($plan->image,253,151,$plan->title) !!}</div>
	    <div class="rate">
	        <span>{{ $plan->daily_profit }}%</span>
	        <p class="mb-0">{{ __('daily forever') }}</p>
	    </div>
	</div>
    <a href="javascript:void(0)" class="btn-grey choose-deposit" data-min="{{ $plan->min_deposit }}" data-max="{{ isset($plans[$key + 1]) ? $plans[$key + 1]->min_deposit : '' }}" data-profit="{{ $plan->daily_profit }}"><i class="fas fa-calculator"></i>{{ __('Calculate') }}</a>
    <p class="deposit">{{ __('Minimum Deposit') }}: <strong>{{ format_currency($plan->min_deposit) }}</strong></p>
</div>