@php 
$menu = get_menu("main-menu"); 
$home_active = Request::is('/')? ' class=active':'';
$url = Request::url();
$server_time = $date = date('m/d/Y');
@endphp
<div id="top-bar">
    <div class="container">
        <div class="wrap">
            <div class="server_time"><i class="far fa-clock"></i>Server Time: {{$server_time}}</div>
            <div class="mail"><i class="far fa-envelope-open"></i>{{get_option('email')}}</div>
            <div class="social">social network:{!!get_option('socail')!!}</div>
        </div>
    </div>
</div>
<div id="logo-menu">
    <div class="container">
        <a href="{{route('home')}}" id="logo">{!! imageAuto(get_option('logo'),'Logo') !!}</a>
        @if($menu) 
        <nav class="menu">
            <ul>
            @foreach($menu as $item)
                @php 
                    $menu_txt = ($item->title_custom!="")? $item->title_custom : $item->title_default;
                    $post_slug = ($item->type!="link")? $item->slug : $item->title_default;
                    $active = (url($item->slug)==$url)? ' class=active':'';
                @endphp
                @if($post_slug=="home")
                    <li><a href="{{route('home')}}"{{$home_active}}>{{$menu_txt}}</a></li>
                @else
                <li><a href="{{route('slug',$post_slug)}}" tager="{{$item->target}}"{{$active}}>{{$menu_txt}}</a></li>
                @endif
            @endforeach
            </ul>
        </nav>
        @endif
        <div class="mob_menu"><span></span></div>
        @auth<a href="{{ route('profile.index') }}" class="btn-cs2">{!! image(Auth::user()->image, 30,30, Auth::user()->displayname) !!}{{ __('Account') }}</a>@endauth
        @guest<a href="{{ route('login') }}" class="btn-cs2"><img src="{{ asset('images-temp/login_ic.png') }}">{{ __('Login') }}</a>@endguest
    </div>
</div>