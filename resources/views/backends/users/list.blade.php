@extends('backends.templates.master')
@section('title',__('Users'))
@section('content')
@php
   $data_link = array();
   if(isset($_GET["s"]) && $_GET["s"] != ''):
      $s = $_GET["s"];
      $data_link['s'] = $s;
   else: 
      $s = '';
   endif;
   if(isset($_GET["role"]) && $_GET["s"] != ''):
      $role = $_GET["role"];
      $data_link['role'] = $role;
   else: 
      $role = '';
   endif;
@endphp
<div id="list-user" class="content-wrapper users">
   <section class="content">
      <div class="head container">
         <h1 class="title">{{ __('Users') }}</h1>
      </div>
      <div class="main">
         <div class="row search-filter">
            <div class="col-md-6 filter">
               <ul class="nav-filter">
                     <li class="active"><a href="{{route('admin.users')}}">{{__('All')}}</a></li>
                     <li class=""><a href="{{route('admin.user_create')}}">{{__('Create')}}</a></li>
               </ul>
            </div>
            <div class="col-md-6 search-form">
               <form name="s" action="{{ route('admin.users') }}" method="GET">
                  <div class="row">
                     <div class="col-md-5 store-cat">
                        <select class="form-control select2bs4" name="role" data-error="{{ __('choose files')}}">
                           <option value="">{{__('All')}}</option>
                           @if($roles)
                              @foreach($roles as $item) 
                              <option value="{{$item->name}}"{{ ($role==$item->name) ? ' selected' : '' }}>{{$item->display_name}}</option>
                              @endforeach
                           @endif
                        </select>
                     </div>
                     <div class="col-md-7 s-key">
                        <input type="text" name="s" class="form-control s-key" placeholder="{{ __('enter key...') }}" value="{{ $s }}">
                     </div>
                     <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                  </div>
               </form>
            </div>
         </div>
         <div class="card">
            <div class="card-body p-0">
               @include('notices.index')
               <form class="dev-form" action="{{route('admin.users_delete_choose')}}" name="listUser" method="POST" role="form">
                  @csrf
                  <table class="table table-striped projects" role="table">
                     <thead class="thead">
                        <tr>
                           <th id="check-all" class="check"><input type="checkbox" name="checkAll"></th>
                           <th class="image">{{ __('Avatar') }}</th>
                           <th>{{ __('Display Name') }}</th>
                           <th>{{ __('Role') }}</th>
                           <th>{{ __('Email') }}</th>
                           <th>{{ __('Phone Number') }}</th>
                           <th>{{ __('Amount') }}</th>
                           <th>{{ __('Date Created') }}</th>
                           <th class="action"></th>
                        </tr>
                     </thead>
                     <tbody class="tbody">
                        @if($users)
                           @foreach($users as $item)
                              <tr>
                                 <td class="check"><input type="checkbox" name="checkbox[]" value="{{$item->id}}"></td>
                                 <td class="image"><a href="{{ route('admin.user_edit',['id'=>$item->id]) }}">{!! image($item->image, 100,100, $item->displayname) !!}</a></td>
                                 <td><a href="{{ route('admin.user_edit',['id'=>$item->id]) }}">{{ $item->displayname }}</a></td>
                                 <td><a href="{{ route('admin.user_edit',['id'=>$item->id]) }}">{{ $item->getRoleNames()->count() > 0 ? $item->getRoleNames()[0] : 'Customer' }}</a></td>
                                 <td>{{ $item->email }}</td>
                                 <td>{{ $item->phone }}</td>
                                 <td>{{ format_currency($item->amount) }}</td>
                                 <td>{{ format_dateCS($item->created_at) }}</td>
                                 <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.user_edit',['id'=>$item->id]) }}"><i class="fas fa-pencil-alt"></i>{{ __('Edit') }}</a>
                                    <a class="btn btn-danger btn-sm" href="{{ route('admin.user_delete',['id'=>$item->id]) }}" data-toggle="modal" data-target="#sideModal" data-direct="modal-top-right"><i class="fas fa-trash"></i>{{__('Delete')}}</a>
                                 </td>
                              </tr>
                           @endforeach
                        @else
                           <tr>
                              <td colspan="8">{{ __('No users!') }}</td>
                           </tr>
                        @endif
                     </tbody>
                  </table>
               </form>
            </div>
         </div>
         {{ $users->appends($data_link)->links() }}
      </div>
   </section>
</div>
@include('modals.modal_delete')
@include('modals.modal_deleteChoose')
@endsection