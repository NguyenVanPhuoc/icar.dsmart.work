@extends('backends.templates.master')
@section('title',__('Add Roles'))
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container">
            <div class="head">
                <a href="{{ route('admin.roles') }}" class="back-icon"><i class="fas fa-angle-left" aria-hidden="true"></i>{{ __('All') }}</a>
                <h1 class="title">{{ __('Add Roles') }}</h1>
            </div>
            <div class="main">
                @include('notices.index')
                <form action="{{ route('admin.role_store') }}" class="dev-form" method="POST" data-toggle="validator" role="form">
                    @csrf
                    <div class="form-group">
                        <label class="control-label">{{ __('Display Name') }} <small>({{ __('require') }})</small></label>
                        <input type="text" name="display_name" value="{{ Request::old('display_name') }}" class="form-control" data-error="{{ __('Please input display name')}}" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">{{ __('Role name') }} <small>({{ __('require') }})</small></label>
                        <input name="name" type="text" class="form-control" value="{{ Request::old('name') }}" data-error="{{ __('Please input role name')}}" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">{{ __('Permissions') }}</label>
                        @if($permissions)
                            @foreach($permissions as $key => $group)
                                <div class="list-item mb-2 ml-4 check__checkbox_all">
                                    <div class="icheck-primary mb-0">
                                        <input type="checkbox" id="checkbox_{{ $key }}" class="parent-check">
                                        <label for="checkbox_{{ $key }}">{{ $key }}</label>
                                        <a href="javascript:void(0);" class="toggle-cs ml-2"><i class="fa fa-angle-right"></i></a>
                                    </div>
                                    <div class="list-child ml-4 pl-4">
                                        @foreach($group as $stt => $item)
                                            <div class="icheck-success">
                                                <input type="checkbox" name="permissions[]" id="checkbox_{{ $key.'_'.$stt }}" value="{{ $item->name }}">
                                                <label for="checkbox_{{ $key.'_'.$stt }}">{{ $item->display_name != null ? $item->display_name : explode('.',$item->name)[1] }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="group-action">
                        <button type="submit" name="submit" class="btn btn-success">{{ __('Save') }}</button>
                        <a href="{{ route('admin.roles') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>	
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection