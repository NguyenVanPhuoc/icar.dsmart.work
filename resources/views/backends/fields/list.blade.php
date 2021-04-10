@extends('backends.templates.master')
@section('title','custom fields')
@section('content')
@php 
  $s = (isset($_GET["s"]) && $_GET["s"] != '')? $_GET["s"] : '';
  $status_post = get_statusPost();
  $status = (isset($_GET["status"]) && $_GET["status"] != '')? $_GET["status"] : '';
@endphp
<div id="list-fields" class="content-wrapper fields">
    <!-- Main content -->
    <section class="content">
      <div class="head container">
        <h1 class="title">{{__('All')}}</h1>
      </div>
      <div class="main">
        <div class="row search-filter">
          <div class="col-md-6 filter">
              <ul class="nav-filter">
                  <li class="active"><a href="{{route('customFieldAdmin')}}">{{__('All')}}</a></li>
                  <li class=""><a href="{{route('storeCustomFieldAdmin')}}">{{__('Create')}}</a></li>
              </ul>
          </div>
          <div class="col-md-6 search-form">
              <form name="s" action="{{route('customFieldAdmin')}}" method="GET">
                  <div class="row">
                    <div class="col-md-12 s-key">
                        <input type="text" name="s" class="form-control s-key" placeholder="{{__('Key word')}}" value="{{$s}}">
                     </div>
                     <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                  </div>
              </form>
          </div>
        </div>
        <div class="card">
          <div class="card-body p-0">
            @include('notices.index')
            <form class="dev-form" action="{{route('deleteChooseCustomFieldAdmin')}}" name="listFields" method="POST" role="form">
              @csrf
              <table class="table table-striped projects" role="table">
                <thead class="thead">
                  <tr>
                    <th id="check-all" class="check"><input type="checkbox" name="checkAll"></th>
                    <th class="title">{{__('Title')}}</th>
                    <th class="date">{{__('Create date')}}</th>
                    <th class="action"></th>
                  </tr>
                </thead>
                <tbody class="tbody">
                  @if(!$fields->isEmpty())
                    @foreach($fields as $item)
                    <tr>
                      <td class="check"><input type="checkbox" name="checkbox[]" value="{{$item->id}}"></td>
                      <td class="title"><a href="{{route('editCustomFieldAdmin',['id'=>$item->id])}}">{{$item->title}}</a></td>
                      <td class="date">{{$item->created_at}}</td>
                      <td class="group-action text-right">
                          <a class="btn btn-info btn-sm" href="{{route('editCustomFieldAdmin',['id'=>$item->id])}}"><i class="fas fa-pencil-alt"></i>{{__('edit')}}</a>
                          <a class="btn btn-danger btn-sm" href="{{route('deleteCustomFieldAdmin',['id'=>$item->id])}}" data-toggle="modal" data-target="#sideModal" data-direct="modal-top-right"><i class="fas fa-trash"></i>{{__('delete')}}</a>
                      </td>
                    </tr>
                    @endforeach
                  @else
                    <tr>
                      <td colspan="7">{{__('No items')}}</td>
                    </tr>
                  @endif
                </tbody>
              </table>
            </form>
          </div>
      </div>
         @if($s)
            {{ $fields->appends(['s'=>$s])->links() }}
         @else
            {{ $fields->links() }}
         @endif
      </div>
    </section>
    <!-- /.content -->
  </div>
<!-- Side Modal Top Right -->
@include('modals.modal_delete')
@include('modals.modal_deleteChoose')
@endsection