<h3 class="sec-title2 mt-3 mb-3">{{ __('Account Information') }}</h3>
<ul class="nav-account">
	@php $current_route = \Route::currentRouteName(); @endphp
	<li{{ $current_route == 'profile.index' ? ' class=active' : '' }}><a href="{{ route('profile.index') }}">{{ __('Account') }}</a></li>
	<li{{ $current_route == 'profile.make_deposit' ? ' class=active' : '' }}><a href="{{ route('profile.make_deposit') }}">{{ __('Make Deposit') }}</a></li>
	<li{{ $current_route == 'profile.deposits_history' ? ' class=active' : '' }}><a href="{{ route('profile.deposits_history') }}">{{ __('Deposits History') }}</a></li>
	<li{{ $current_route == 'profile.recharge' ? ' class=active' : '' }}><a href="{{ route('profile.recharge') }}">{{ __('Recharge Request') }}</a></li>
	<li{{ $current_route == 'profile.earning_history' ? ' class=active' : '' }}><a href="{{ route('profile.earning_history') }}">{{ __('Earnings History') }}</a></li>
	<li{{ $current_route == 'profile.withdraw' ? ' class=active' : '' }}><a href="{{ route('profile.withdraw') }}">{{ __('Withdraw') }}</a></li>
	<li{{ $current_route == 'profile.withdraw_history' || $current_route == 'profile.withdraw_detail' ? ' class=active' : '' }}><a href="{{ route('profile.withdraw_history') }}">{{ __('Withdrawals History') }}</a></li>
	<li{{ $current_route == 'profile.referrals' ? ' class=active' : '' }}><a href="{{route('profile.referrals') }}">{{ __('Your Referrals') }}</a></li>
	<li{{ $current_route == 'profile.referral_history' ? ' class=active' : '' }}><a href="{{ route('profile.referral_history') }}">{{ __('Referrals History') }}</a></li>
	<li{{ $current_route == 'profile.edit' ? ' class=active' : '' }}><a href="{{ route('profile.edit') }}">{{ __('Edit Account') }}</a></li>
	<form method="POST" action="{{ route('logout') }}">
        @csrf
        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</a></li>
    </form>
</ul>
