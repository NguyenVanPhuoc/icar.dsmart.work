@extends('backends.templates.master')
@section('title', __('Investment Plans'))
@section('content')
<div id="list-events" class="content-wrapper events">
   <section class="content">
      <div class="head container">
         <h1 class="title">{{ __('Investment Plans') }}</h1>
      </div>
      <div class="main">
         <div class="row search-filter">
            <div class="col-md-6 filter">
               <ul class="nav-filter">
                  <li class="active"><a href="{{ route('admin.plans') }}">{{ __('All') }}</a></li>
                  <li class=""><a href="{{ route('admin.plan_create') }}">{{ __('Create New') }}</a></li>
               </ul>
            </div>
            <div class="col-md-6 search-form">
               <form name="s" action="{{ route('admin.plans') }}" method="GET">
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
               <form class="dev-form" action="{{ route('admin.plans_delete_choose') }}" method="POST" role="form">
                  @csrf
                  <table class="table table-striped projects" role="table">
                     <thead class="thead">
                        <tr>
                           <th id="check-all" class="check"><input type="checkbox" name="checkAll"></th>
                           <th>{{ __('Name') }}</th>
                           <th class="text-center">{{ __('Thumbnail') }}</th>
                           <th class="text-center">{{ __('Minimum Deposit') }}</th>
                           <th class="text-center">{{ __('Daily Profit') }}</th>
                           <th>{{ __('Date Created') }}</th>
                           <th>{{ __('Date Updated') }}</th>
                           <th class="action"></th>
                        </tr>
                     </thead>
                     <tbody class="tbody">
                        @if(!$plans->isEmpty())
                        @foreach($plans as $item)
                        <tr>
                           <td class="check"><input type="checkbox" name="checkbox[]" value="{{ $item->id }}"></td>
                           <td><a href="{{ route('admin.plan_edit',['id'=>$item->id]) }}">{{ $item->title }}</a></td>
                           <td class="text-center"><a href="{{ route('admin.plan_edit',['id'=>$item->id]) }}">{!! image($item->image, 150,100, $item->title) !!}</a></td>
                           <td class="text-center">{{ format_currency($item->min_deposit) }}</td>
                           <td class="text-center">{{ $item->daily_profit.'%' }}</td>
                           <td>{{ format_dateCS($item->created_at) }}</td>
                           <td>{{ format_dateCS($item->updated_at) }}</td>
                           <td class="group-action text-right">
                              <a class="btn btn-info btn-sm" href="{{ route('admin.plan_edit',['id'=>$item->id]) }}"><i class="fas fa-pencil-alt"></i>{{ __('Edit') }}</a>
                              <a class="btn btn-danger btn-sm" href="{{ route('admin.plan_delete',['id'=>$item->id]) }}" data-toggle="modal" data-target="#sideModal" data-direct="modal-top-right"><i class="fas fa-trash"></i>{{ __('Delete') }}</a>
                           </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                           <td colspan="6">{{ __('No items!') }}</td>
                        </tr>
                        @endif
                     </tbody>
                  </table>
               </form>
            </div>
         </div>
         @if($keyword != '')
            {{ $plans->appends(['keyword'=>$keyword])->links() }}
         @else
            {{ $plans->links() }}
         @endif
      </div>
   </section>
   <!-- /.content -->
</div>
<!-- Side Modal Top Right -->
@include('modals.modal_delete')
@include('modals.modal_deleteChoose')
@endsection