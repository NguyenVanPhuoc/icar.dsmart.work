@extends('backends.templates.master')
@section('title','Faqs')
@section('content')
@php 
  $s = (isset($_GET["s"]) && $_GET["s"] != '')? $_GET["s"] : '';
  $status_post = get_statusPost();
  $status = (isset($_GET["status"]) && $_GET["status"] != '')? $_GET["status"] : '';
@endphp
<div id="list-pages" class="content-wrapper pages">
    <!-- Main content -->
    <section class="content">
      <div class="head container">
        <h1 class="title">{{__('All')}}</h1>
      </div>
      <div class="main">
        <div class="row search-filter">
          <div class="col-md-6 filter">
              <ul class="nav-filter">
                  <li class="active"><a href="{{route('faqsAdmin')}}">{{__('All')}}</a></li>
                  <li class=""><a href="{{route('storeFaqsAdmin')}}">{{__('Create')}}</a></li>
              </ul>
          </div>
          <div class="col-md-6 search-form">
              <form name="s" action="{{route('faqsAdmin')}}" method="GET">
                  <div class="row">
                     <div class="col-md-5 store-cat">
                        <select class="form-control select2bs4" name="status">
                           <option value="">{{__('All')}}</option>
                           @foreach($status_post as $key => $value) 
                            <option value="{{$key}}"@if($key == $status){{__(' selected')}}@endif>{{$status_post[$key]}}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="col-md-7 s-key">
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
            <form class="dev-form" action="{{route('deleteChooseFaqsAdmin')}}" name="listPages" method="POST" role="form">
              @csrf
              <table class="table table-striped projects" role="table">
                <thead class="thead">
                  <tr>
                    <th id="check-all" class="check"><input type="checkbox" name="checkAll"></th>
                    <th class="title">{{__('Title')}}</th>
                    <th class="author">{{__('Author')}}</th>
                    <th class="date">{{__('Create date')}}</th>
                    <th class="status">{{__('Status')}}</th>
                    <th class="action"></th>
                  </tr>
                </thead>
                <tbody class="tbody">
                  @if(!$faqs->isEmpty())
                    @foreach($faqs as $item)
                    <tr>
                      <td class="check"><input type="checkbox" name="checkbox[]" value="{{$item->post_id}}"></td>
                      <td class="title"><a href="{{route('editFaqsAdmin',['id'=>$item->id])}}">{{$item->title}}</a></td>
                      <td class="author">{{$item->author}}</td>
                      <td class="date">{{$item->created_at}}</td>
                      <td class="status">{!!get_htmlStatusPost($item->status)!!}</td>
                      <td class="group-action text-right">
                          <a class="btn btn-info btn-sm" href="{{route('editFaqsAdmin',['id'=>$item->id])}}"><i class="fas fa-pencil-alt"></i>{{__('edit')}}</a>
                          <a class="btn btn-danger btn-sm" href="{{route('deleteFaqsAdmin',['id'=>$item->id])}}" data-toggle="modal" data-target="#sideModal" data-direct="modal-top-right"><i class="fas fa-trash"></i>{{__('delete')}}</a>
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
      @if($s && $status)
            {{ $faqs->appends(['status'=>$status,'s'=>$s])->links() }}
         @elseif($s)
            {{ $faqs->appends(['s'=>$s])->links() }}
         @elseif($status)
            {{ $faqs->appends(['status'=>$status])->links() }}
         @else
            {{ $faqs->links() }}
         @endif
      </div>
    </section>
    <!-- /.content -->
  </div>
<!-- Side Modal Top Right -->
@include('modals.modal_delete')
@include('modals.modal_deleteChoose')
@endsection