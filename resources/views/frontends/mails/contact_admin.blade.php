<div style="max-width: 540px; padding:10px 50px; margin:0 auto; font-size: 15px; line-height: 21px;">
	<h2 style="font-size: 17px; margin-bottom: 0">{{__('Notify')}}!</h2>
	<p>{{__('System receive respon from website')}} <a href="{{url('/')}}">{{url('/')}}</a> of client <strong>{{$data['name']}}</strong> {{__('with content')}}:</p>	
	{!!$data['message']!!}
	<p style="margin-bottom: 0">{{__('Contact clien now, please')}}.</p>
	<p style="margin-top: 5px"><strong><i>{{__('Thanks')}}.</i></strong></p>
	<div style="padding-top:20px;">
		<h3>{{__('Contact information')}}</h3>
		<p>{{__('Website')}}: <a href="{{url('/')}}">{{url('/')}}</a></p>
		<div>{{__('Address')}}: {!!get_option('address')!!}</div>
		<p>{{__('Email')}}: {{get_option('email')}}</p>
		<p>{{__('Hotline')}}: <a href="tel:{{get_option('hotline')}}">{{get_option('hotline')}}</a></p>
	</div>
</div>