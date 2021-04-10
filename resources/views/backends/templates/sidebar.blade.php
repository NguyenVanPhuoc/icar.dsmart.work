<aside class="main-sidebar sidebar-dark-warning elevation-4">
   <div class="brand-link">
      <a href="#" class="logo-text">
         <img src="{{ asset('images-temp/AdminLogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">{{get_option('site_name')}}</span>
      </a>
      <a href="{{url('/')}}" target="_blank" class="home-page" title="home page"><i class="fas fa-home"></i></a>
   </div>
   <div class="sidebar">
         {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">{!!image($user->image_id,160,160,$user->name)!!}</div>
            <div class="info">
               <a href="#" class="d-block">{{$user->name}}</a>
            </div>
         </div> --}}
      <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview{{ Request::is('admin','admin/log','admin/log/*')? ' menu-open': '' }}">
               <a href="#" class="nav-link{{ Request::is('admin','admin/dashboard','admin/log','admin/log/*')? ' active': '' }}">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>{{ __('Dashboard') }}<i class="fas fa-angle-left right"></i></p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{ route('dashboard') }}" class="nav-link{{ Request::is('admin','admin/dashboard')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{__('All')}}</p>
                     </a>
                  </li>            
               </ul>
            </li>
            <li class="nav-item has-treeview{{ Request::is('admin/page','admin/page/*')? ' menu-open': '' }}">
               <a href="#" class="nav-link{{ Request::is('admin/page','admin/page/*')? ' active': '' }}">
                  <i class="nav-icon fas fa-file"></i>
                  <p>{{ __('Pages') }}<i class="fas fa-angle-left right"></i></p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{ route('pageAdmin') }}" class="nav-link{{ Request::is('admin/page')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('All') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('storePageAdmin') }}" class="nav-link{{ Request::is('admin/page/create')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Add new') }}</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="nav-item has-treeview{{ Request::is('admin/faqs','admin/faqs/*')? ' menu-open': '' }}">
               <a href="#" class="nav-link{{ Request::is('admin/faqs','admin/faqs/*')? ' active': '' }}">
                  <i class="nav-icon far fa-question-circle"></i>
                  <p>{{ __('FAQs') }}<i class="fas fa-angle-left right"></i></p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{ route('faqsAdmin') }}" class="nav-link{{ Request::is('admin/faqs')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('All') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{route('storeFaqsAdmin')}}" class="nav-link{{ Request::is('admin/faqs/create')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Add new') }}</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="nav-item has-treeview{{ Request::is('admin/plans','admin/plans/*')? ' menu-open': '' }}">
               <a href="#" class="nav-link{{ Request::is('admin/plans','admin/plans/*')? ' active': '' }}">
                  <i class="nav-icon fas fa-money-bill-wave"></i>
                  <p>{{ __('Investment Plans') }}<i class="fas fa-angle-left right"></i></p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{ route('admin.plans') }}" class="nav-link{{ Request::is('admin/plans', 'admin/plans/edit/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('All') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('admin.plan_create') }}" class="nav-link{{ Request::is('admin/plans/create')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Add new') }}</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="nav-item has-treeview{{ Request::is('admin/deposits','admin/deposits/*')? ' menu-open': '' }}">
               <a href="#" class="nav-link{{ Request::is('admin/deposits','admin/deposits/*')? ' active': '' }}">
                  <i class="fas fa-hand-holding-usd"></i>
                  <p>{{ __('Deposits') }}<i class="fas fa-angle-left right"></i></p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{ route('admin.deposits') }}" class="nav-link{{ Request::is('admin/deposits', 'admin/deposits/edit/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('All') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('admin.deposit_create') }}" class="nav-link{{ Request::is('admin/deposits/create')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Add new') }}</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="nav-item has-treeview{{ Request::is('admin/transactions','admin/transactions/*')? ' menu-open': '' }}">
               <a href="#" class="nav-link{{ Request::is('admin/transactions','admin/transactions/*')? ' active': '' }}">
                  <i class="fas fa-file-invoice-dollar"></i>
                  <p>{{ __('Deposit / Withdrawal') }}<i class="fas fa-angle-left right"></i></p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{ route('admin.transactions') }}" class="nav-link{{ Request::is('admin/transactions', 'admin/transactions/edit/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('All') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('admin.transaction_create') }}" class="nav-link{{ Request::is('admin/transactions/create')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Add new') }}</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="nav-item has-treeview{{ Request::is('admin/affiate','admin/affiate/*')? ' menu-open': '' }}">
               <a href="#" class="nav-link{{ Request::is('admin/affiate','admin/affiate/*')? ' active': '' }}">
                  <i class="nav-icon fas fa-money-bill-wave"></i>
                  <p>{{ __('Affiates') }}<i class="fas fa-angle-left right"></i></p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{route('affiateAdmin')}}" class="nav-link{{ Request::is('admin/affiate', 'admin/affiate/edit/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('All') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('storeAffiateAdmin') }}" class="nav-link{{ Request::is('admin/affiate/create')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Add new') }}</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="nav-item has-treeview{{ Request::is('admin/media','admin/media/*','admin/media-cate','admin/media-cate/*')? ' menu-open': '' }}">
               <a href="#" class="nav-link{{ Request::is('admin/media','admin/media/*','admin/media-cate','admin/media-cate/*')? ' active': '' }}">
                  <i class="nav-icon far fa-image"></i>
                  <p>{{ __('Libraries') }}<i class="fas fa-angle-left right"></i></p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{ route('mediaAdmin') }}" class="nav-link{{ Request::is('admin/media','admin/media/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('All') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('mediaCatAdmin') }}" class="nav-link{{ Request::is('admin/media-cate','admin/media-cate/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Categories') }}</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="nav-item has-treeview{{ Request::is('admin/user','admin/user/*')? ' menu-open': '' }}">
               <a href="#" class="nav-link{{ Request::is('admin/user','admin/user/*')? ' active': '' }}">
                  <i class="nav-icon fas fa-users"></i>
                  <p>{{ __('Users') }}<i class="fas fa-angle-left right"></i></p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{ route('admin.users') }}" class="nav-link{{ Request::is('admin/user', 'admin/user/edit/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('All') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('admin.user_create') }}" class="nav-link{{ Request::is('admin/user/create')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Add new') }}</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="nav-item has-treeview{{ Request::is('admin/custom-fields','admin/custom-fields/*')? ' menu-open': '' }}">
               <a href="#" class="nav-link{{ Request::is('admin/custom-fields','admin/custom-fields/*')? ' active': '' }}">
                  <i class="nav-icon fa fa-th-large"></i>
                  <p>{{ __('Custom fields') }}<i class="fas fa-angle-left right"></i></p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{ route('customFieldAdmin') }}" class="nav-link{{ Request::is('admin/custom-fields', 'admin/custom-fields/edit/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('All') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('storeCustomFieldAdmin') }}" class="nav-link{{ Request::is('admin/custom-fields/create')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Add new') }}</p>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="nav-item has-treeview{{ Request::is('admin/system','admin/system/*')? ' menu-open': '' }}">
               <a href="#" class="nav-link{{ Request::is('admin/system','admin/system/*')? ' active': '' }}">
                  <i class="nav-icon fas fa-cog"></i>
                  <p>{{ __('Setting') }}<i class="fas fa-angle-left right"></i></p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{ route('menuAdmin') }}" class="nav-link{{ Request::is('admin/system/menu','admin/system/menu/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Menus') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('admin.system') }}" class="nav-link{{ Request::is('admin/system/option')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('System') }}</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('admin.roles') }}" class="nav-link{{ Request::is('admin/system/roles', 'admin/system/roles/*')? ' active': '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Roles and Permissions') }}</p>
                     </a>
                  </li>            
               </ul>
            </li>
            <li class="nav-item">
               <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                     <i class="fas fa-sign-out-alt nav-icon"></i>{{ __('Logout') }}
                  </a>
               </form>
            </li>
         </ul>
      </nav>
   </div>
</aside>