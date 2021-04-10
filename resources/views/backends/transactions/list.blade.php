@extends('backends.templates.master')
@section('title', __('Transactions'))
@section('content')
<div id="list-events" class="content-wrapper events">
   <section class="content">
      <div class="head container">
         <h1 class="title">{{ __('Transactions') }}</h1>
      </div>
      <div class="main">
         <div class="row search-filter">
            <div class="col-md-6 filter">
               <ul class="nav-filter">
                  <li class="active"><a href="{{ route('admin.transactions') }}">{{ __('All') }}</a></li>
                  <li class=""><a href="{{ route('admin.transaction_create') }}">{{ __('Create New') }}</a></li>
               </ul>
            </div>
            <div class="col-md-6 search-form">
               <form name="s" action="{{ route('admin.transactions') }}" method="GET">
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
               <form class="dev-form" action="{{ route('admin.transactions_delete_choose') }}" method="POST" role="form">
                  @csrf
                  <table class="table table-striped projects" role="table">
                     <thead class="thead">
                        <tr>
                           <th id="check-all" class="check"><input type="checkbox" name="checkAll"></th>
                           <th>{{ __('User') }}</th>
                           <th class="text-center">{{ __('Type') }}</th>
                           <th class="text-center">{{ __('Amount') }}</th>
                           <th class="text-center">{{ __('Status') }}</th>
                           <th class="text-center">{{ __('Date Created') }}</th>
                           <th class="text-center">{{ __('Date Updated') }}</th>
                           <th class="action"></th>
                        </tr>
                     </thead>
                     <tbody class="tbody">
                        @if(!$list->isEmpty())
                           @foreach($list as $item)
                              <tr>
                                 <td class="check"><input type="checkbox" name="checkbox[]" value="{{ $item->id }}"></td>
                                 <td><a href="{{ route('admin.transaction_edit',['id'=>$item->id]) }}">{{ isset($item->user) ? $item->user->displayname : 'NULL' }}</a></td>
                                 <td class="text-center">{{ $types[$item->type] }}</td>
                                 <td class="text-center">{{ format_currency($item->amount) }}</td>
                                 <td class="text-center">{{ $statuses[$item->status] }}</td>
                                 <td class="text-center">{{ format_dateCS($item->created_at) }}</td>
                                 <td class="text-center">{{ format_dateCS($item->updated_at) }}</td>
                                 <td class="group-action text-right">
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.transaction_edit',['id'=>$item->id]) }}"><i class="fas fa-pencil-alt"></i>{{ __('Edit') }}</a>
                                    <a class="btn btn-danger btn-sm" href="{{ route('admin.transaction_delete',['id'=>$item->id]) }}" data-toggle="modal" data-target="#sideModal" data-direct="modal-top-right"><i class="fas fa-trash"></i>{{ __('Delete') }}</a>
                                 </td>
                              </tr>
                           @endforeach
                        @else
                        <tr>
                           <td colspan="7" class="text-center">{{ __('No items!') }}</td>
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