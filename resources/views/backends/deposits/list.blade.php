@extends('backends.templates.master')
@section('title', __('Deposits'))
@section('content')
<div id="list-events" class="content-wrapper events">
   <section class="content">
      <div class="head container">
         <h1 class="title">{{ __('Deposits') }}</h1>
      </div>
      <div class="main">
         <div class="row search-filter">
            <div class="col-md-6 filter">
               <ul class="nav-filter">
                  <li class="active"><a href="{{ route('admin.deposits') }}">{{ __('All') }}</a></li>
                  <li class=""><a href="{{ route('admin.deposit_create') }}">{{ __('Create New') }}</a></li>
               </ul>
            </div>
            <div class="col-md-6 search-form">
               <form name="s" action="{{ route('admin.deposits') }}" method="GET">
                  <div class="row">
                     <div class="col-md-12 s-key">
                        <input type="text" name="keyword" class="form-control s-key" placeholder="{{ __('Keyword') }}" value="{{ $keyword }}">
                     </div>
                     <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                  </div>
               </form>
            </div>
         </div>
         <div class="card">
            <div class="card-body p-0">
               @include('notices.index')
               <form class="dev-form" action="{{ route('admin.deposits_delete_choose') }}" method="POST" role="form">
                  @csrf
                  <table class="table table-striped projects" role="table">
                     <thead class="thead">
                        <tr>
                           <th id="check-all" class="check"><input type="checkbox" name="checkAll"></th>
                           <th>{{ __('Username') }}</th>
                           <th class="text-center">{{ __('Investment Plan') }}</th>
                           <th class="text-center">{{ __('Amount') }}</th>
                           <th class="text-center">{{ __('Date Created') }}</th>
                           <th class="text-center">{{ __('Date Updated') }}</th>
                           <th class="action"></th>
                        </tr>
                     </thead>
                     <tbody class="tbody">
                        @if(!$list->isEmpty())
                           @foreach($list as $item)
                              @php
                                 if(isset($item->user)) $Username = $item->user->displayname;
                                    else $Username = isset($item->detail['username']) ? $item->detail['username'] : 'NULL';
                                 if(isset($item->plan)) $Planname = $item->plan->title;
                                    else $Planname = isset($item->detail['planname']) ? $item->detail['planname'] : 'NULL';
                              @endphp
                              <tr>
                                 <td class="check"><input type="checkbox" name="checkbox[]" value="{{ $item->id }}"></td>
                                 <td><a href="{{ route('admin.deposit_edit',['id'=>$item->id]) }}">{{ $Username }}</a></td>
                                 <td class="text-center"><a href="{{ route('admin.deposit_edit',['id'=>$item->id]) }}">{{ $Planname }}</a></td>
                                 <td class="text-center">{{ format_currency($item->amount) }}</td>
                                 <td class="text-center">{{ format_dateCS($item->created_at) }}</td>
                                 <td class="text-center">{{ format_dateCS($item->updated_at) }}</td>
                                 <td class="group-action text-right">
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.deposit_edit',['id'=>$item->id]) }}"><i class="fas fa-pencil-alt"></i>{{ __('Edit') }}</a>
                                    <a class="btn btn-danger btn-sm" href="{{ route('admin.deposit_delete',['id'=>$item->id]) }}" data-toggle="modal" data-target="#sideModal" data-direct="modal-top-right"><i class="fas fa-trash"></i>{{ __('Delete') }}</a>
                                 </td>
                              </tr>
                           @endforeach
                        @else
                           <tr>
                              <td colspan="8" class="text-center">{{ __('No items!') }}</td>
                           </tr>
                        @endif
                     </tbody>
                  </table>
               </form>
            </div>
         </div>
         @if($keyword != '')
            {{ $list->appends(['keyword'=>$keyword])->links() }}
         @else
            {{ $list->links() }}
         @endif
      </div>
   </section>
   <!-- /.content -->
</div>
<!-- Side Modal Top Right -->
@include('modals.modal_delete')
@include('modals.modal_deleteChoose')
@endsection