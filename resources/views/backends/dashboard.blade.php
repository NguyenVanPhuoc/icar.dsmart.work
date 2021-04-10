@extends('backends.templates.master')
@section('title', __('Dashboard'))
@section('content')
   <div class="content-wrapper">
      <section class="content">
         <div class="container-fluid">
            <div class="head">
               <h1 class="title">{{ __('Dashboard') }}</h1>
            </div>
            <div class="row">
               <div class="col-lg-3 col-6">
                  <div class="small-box bg-info">
                     <div class="inner">
                        <h3>{{ $total_user }}</h3>
                        <p>{{ __('Total User') }}</p>
                     </div>
                     <div class="icon"><i class="fas fa-users"></i></div>
                     <a href="{{ route('admin.users') }}" class="small-box-footer" title="{{ __('View all') }}" target="_blank">{{ __('View all') }} <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>
               <div class="col-lg-3 col-6">
                  <div class="small-box bg-success">
                     <div class="inner">
                        <h3>{{ $total_referral }}</h3>
                        <p>{{ __('Total Referrals') }}</p>
                     </div>
                     <div class="icon"><i class="fas fa-user-plus"></i></div>
                     <a href="{{ route('admin.users') }}" class="small-box-footer" title="{{ __('View all') }}" target="_blank">{{ __('View all') }} <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>  
               <div class="col-lg-3 col-6">
                  <div class="small-box bg-info">
                     <div class="inner">
                        <h3>{{ $total_plan }}</h3>
                        <p>{{ __('Total Investment Plan') }}</p>
                     </div>
                     <div class="icon"><i class="fas fa-cubes"></i></div>
                     <a href="{{ route('admin.plans') }}" class="small-box-footer" title="{{ __('View all') }}" target="_blank">{{ __('View all') }} <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>
               <div class="col-lg-3 col-6">
                  <div class="small-box bg-success">
                     <div class="inner">
                        <h3>{{ $total_investor }}</h3>
                        <p>{{ __('Total Investor') }}</p>
                     </div>
                     <div class="icon"><i class="fas fa-user-check"></i></div>
                     <a href="" class="small-box-footer" title="{{ __('View all') }}" target="_blank">{{ __('View all') }} <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>
                         
               <div class="col-lg-3 col-6">
                  <div class="small-box bg-info">
                     <div class="inner">
                        <h3>{{ format_currency($total_recharge) }}</h3>
                        <p>{{ __('Recharge to Account') }}</p>
                     </div>
                     <div class="icon"><i class="fas fa-comment-dollar"></i></div>
                     <a href="{{ route('admin.transactions') }}" class="small-box-footer" title="{{ __('View all') }}" target="_blank">{{ __('View all') }} <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>
               <div class="col-lg-3 col-6">
                  <div class="small-box bg-success">
                     <div class="inner">
                        <h3>{{ format_currency($total_turover) }}</h3>
                        <p>{{ __('Turnover') }}</p>
                     </div>
                     <div class="icon"><i class="fas fa-gift"></i></div>
                     <a href="" class="small-box-footer" title="{{ __('View all') }}" target="_blank">{{ __('View all') }} <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>
               <div class="col-lg-3 col-6">
                  <div class="small-box bg-info">
                     <div class="inner">
                        <h3>{{ format_currency($total_withdraw) }}</h3>
                        <p>{{ __('Withdrawls') }}</p>
                     </div>
                     <div class="icon"><i class="fas fa-donate"></i></div>
                     <a href="{{ route('admin.transactions') }}" class="small-box-footer" title="{{ __('View all') }}" target="_blank">{{ __('View all') }} <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>            
               <div class="col-lg-3 col-6">
                  <div class="small-box bg-success">
                     <div class="inner">
                        <h3>{{ format_currency($total_invested) }}</h3>
                        <p>{{ __('Total Invested') }}</p>
                     </div>
                     <div class="icon"><i class="fas fa-hand-holding-usd"></i></div>
                     <a href="{{ route('admin.plans') }}" class="small-box-footer" title="{{ __('View all') }}" target="_blank">{{ __('View all') }} <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-6 col-12">
                  <div class="card">
                     <div class="card-header border-transparent">
                        <h3 class="card-title font-weight-bold">{{ __('Ranking of Investment Plans') }}</h3>
                     </div>
                     <div class="card-body pt-0 pb-0">
                        <div class="table-responsive">
                           <table class="table m-0">
                              <thead>
                                 <tr>
                                    <th>{{ __('No') }}</th>
                                    <th class="text-center">{{ __('Investment Plan') }}</th>
                                    <th class="text-center">{{ __('Daily Profit') }}</th>
                                    <th class="text-center">{{ __('Total Deposits') }}</th>
                                    <th class="text-center">{{ __('Times') }}</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @if($rank_plans)
                                    @foreach($rank_plans as $key => $item)
                                       <tr>
                                          <td>{!! ordinal_suffix_of($key+1) !!}</td>
                                          <td class="text-center"><a href="{{ route('admin.plan_edit',['id'=>$item->id]) }}">{{ $item->title }}</a></td>
                                          <td class="text-center">{{ $item->daily_profit.'%' }}</a></td>
                                          <td class="text-center">{{ format_currency($item->deposits->sum('amount')) }}</a></td>
                                          <td class="text-center">{{ $item->deposits_count }}</td>
                                       </tr>
                                    @endforeach
                                 @else
                                    <tr><td colspan="4" class="text-center">{{ __('No Investment Plan!') }}</td></tr>
                                 @endif
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="card-footer clearfix">
                        <a href="{{ route('admin.plans') }}" class="btn btn-sm btn-info float-right" target="_blank">{{ __('All Investment Plan') }}</a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-7 col-12">
                  <div class="card">
                     <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-chart-bar mr-1"></i>{{ __('Monthly Transactions') }}</h3>
                        <div class="card-tools">
                           <ul class="nav nav-pills ml-auto">
                              <li class="nav-item">
                                 <a class="nav-link active" href="#revenue-area" data-toggle="tab">{{ __('Area') }}</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="#revenue-bar" data-toggle="tab">{{ __('Bar') }}</a>
                              </li>
                           </ul>
                        </div>
                     </div>
                     <div class="card-body">
                        <div class="tab-content p-0">
                           <div class="chart tab-pane active" id="revenue-area" style="position: relative; height: 400px;" data="{{ json_encode($monthly_deposit) }}" data-label="{{ json_encode($month_label) }}" data2="{{ json_encode($monthly_withdrawals) }}" data3="{{ json_encode($monthly_recharges) }}" label="{{ $transaction_label }}" data-type="line" radius="3" data-suffix="$" elements='3'>
                              <canvas class="statistics-chart-canvas" id="monthly-area-canvas" style="height: 400px;"></canvas>
                           </div>
                           <div class="chart tab-pane" id="revenue-bar" style="position: relative; height: 400px;" data="{{ json_encode($monthly_deposit) }}" data-label="{{ json_encode($month_label) }}" data2="{{ json_encode($monthly_withdrawals) }}" data3="{{ json_encode($monthly_recharges) }}" label="{{ $transaction_label }}" data-type="bar" radius="3" data-suffix="$" elements="3" data-grid="yes">
                              <canvas class="statistics-chart-canvas" id="monthly-chart-canvas" style="height: 400px;"></canvas>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card">
                     <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-chart-bar mr-1"></i>{{ __('Daily Transactions') }}</h3>
                        <div class="card-tools">
                           <ul class="nav nav-pills ml-auto">
                              <li class="nav-item">
                                 <a class="nav-link active" href="#daily-area" data-toggle="tab">{{ __('Area') }}</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="#daily-bar" data-toggle="tab">{{ __('Bar') }}</a>
                              </li>
                           </ul>
                        </div>
                     </div>
                     <div class="card-body">
                        <div class="tab-content p-0">
                           <div class="chart tab-pane active" id="daily-area" style="position: relative; height: 400px;" data="{{ json_encode($daily_deposit) }}" data-label="{{ json_encode($daily_label) }}" data2="{{ json_encode($daily_withdrawals) }}" data3="{{ json_encode($daily_recharges) }}" label="{{ $transaction_label }}" data-type="line" radius="3" data-suffix="$" elements='3'>
                              <canvas class="statistics-chart-canvas" id="daily-area-canvas" style="height: 400px;"></canvas>
                           </div>
                           <div class="chart tab-pane" id="daily-bar" style="position: relative; height: 400px;" data="{{ json_encode($daily_deposit) }}" data-label="{{ json_encode($daily_label) }}" data2="{{ json_encode($daily_withdrawals) }}" data3="{{ json_encode($daily_recharges) }}" label="{{ $transaction_label }}" data-type="bar" radius="3" data-suffix="$" elements="3" data-grid="yes">
                              <canvas class="statistics-chart-canvas" id="daily-chart-canvas" style="height: 400px;"></canvas>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-5 col-12">
                  <div class="card">
                     <div class="card-header border-transparent">
                        <h3 class="card-title font-weight-bold">{{ __('Recently Deposit') }}</h3>
                     </div>
                     <div class="card-body pt-0 pb-0">
                        <div class="table-responsive">
                           <table class="table m-0">
                              <thead>
                                 <tr>
                                    <th>{{ __('User') }}</th>
                                    <th class="text-center">{{ __('Investment') }}</th>
                                    <th class="text-center">{{ __('Amount') }}</th>
                                    <th class="text-right">{{ __('Created date') }}</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @if($new_deposit)
                                    @foreach($new_deposit as $item)
                                       <tr>
                                          <td>
                                             {{ $item->user ? $item->user->display_name() : $item->detail['username'] }}
                                          </td>
                                          <td class="text-center">{{ $item->plan ? $item->plan->title : $item->detail['planname'] }}</td>
                                          <td class="text-center">{{ format_currency($item->amount) }}</a></td>
                                          <td class="text-right">{{ format_dateCS($item->created_at) }}</td>
                                       </tr>
                                    @endforeach
                                 @else
                                    <tr><td colspan="4" class="text-center">{{ __('No Deposits!') }}</td></tr>
                                 @endif
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="card-footer clearfix">
                        <a href="{{ route('admin.deposits') }}" class="btn btn-sm btn-info float-right" target="_blank">{{ __('All Deposit') }}</a>
                     </div>
                  </div>
                  <div class="card">
                     <div class="card-header border-transparent">
                        <h3 class="card-title font-weight-bold">{{ __('Withdrawals Request') }}</h3>
                     </div>
                     <div class="card-body pt-0 pb-0">
                        <div class="table-responsive">
                           <table class="table m-0">
                              <thead>
                                 <tr>
                                    <th>{{ __('User') }}</th>
                                    <th class="text-center">{{ __('Description') }}</th>
                                    <th class="text-center">{{ __('Amount') }}</th>
                                    <th class="text-right">{{ __('Created date') }}</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @if($request_withdraw)
                                    @foreach($request_withdraw as $item)
                                       <tr>
                                          <td><a href="{{ route('admin.transaction_edit',['id'=>$item->id]) }}">{{ $item->user ? $item->user->display_name() : __('Customer') }}</a></td>
                                          <td class="text-center">{!! str_limit($item->content, 20, '...') !!}</td>
                                          <td class="text-center">{{ format_currency($item->amount) }}</a></td>
                                          <td class="text-right">{{ format_dateCS($item->created_at) }}</td>
                                       </tr>
                                    @endforeach
                                 @else
                                    <tr><td colspan="4" class="text-center">{{ __('No Withdrawals!') }}</td></tr>
                                 @endif
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="card-footer clearfix">
                        <a href="{{ route('admin.transactions') }}" class="btn btn-sm btn-info float-right" target="_blank">{{ __('All Withdrawals') }}</a>
                     </div>
                  </div>
                  <div class="card">
                     <div class="card-header border-transparent">
                        <h3 class="card-title font-weight-bold">{{ __('Recharge to account Request') }}</h3>
                     </div>
                     <div class="card-body pt-0 pb-0">
                        <div class="table-responsive">
                           <table class="table m-0">
                              <thead>
                                 <tr>
                                    <th>{{ __('User') }}</th>
                                    <th class="text-center">{{ __('Description') }}</th>
                                    <th class="text-center">{{ __('Amount') }}</th>
                                    <th class="text-right">{{ __('Created date') }}</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @if($request_recharge)
                                    @foreach($request_recharge as $item)
                                       <tr>
                                          <td><a href="{{ route('admin.transaction_edit',['id'=>$item->id]) }}">{{ $item->user ? $item->user->display_name() : __('Customer') }}</a></td>
                                          <td class="text-center">{!! str_limit($item->content, 20, '...') !!}</td>
                                          <td class="text-center">{{ format_currency($item->amount) }}</a></td>
                                          <td class="text-right">{{ format_dateCS($item->created_at) }}</td>
                                       </tr>
                                    @endforeach
                                 @else
                                    <tr><td colspan="4" class="text-center">{{ __('No Recharges!') }}</td></tr>
                                 @endif
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="card-footer clearfix">
                        <a href="{{ route('admin.transactions') }}" class="btn btn-sm btn-info float-right" target="_blank">{{ __('All Recharges') }}</a>
                     </div>
                  </div>
               </div>
            </div>         
         </div>
      </section>
   </div>
@endsection