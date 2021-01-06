<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('template_admin')}}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{session("username")}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i>  {{session("hak_akses")}}</a>
        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <li class="{{session('active_menu')=='dashboard'?'active':''}}">
          <a href="{{ route('cpanel.dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        @if(session('data_supplier_menu')==1)
        <li class="{{session('active_menu')=='data_supplier'?'active':''}}">
          <a href="{{ route('cpanel.data_supplier') }}">
            <i class="fa fa-users"></i> <span>Data Supplier</span>
          </a>
        </li>
        @endif
        @if(session('request_order_menu')==1)
        <li class="{{session('active_menu')=='request_order'?'active':''}}">
          <a href="{{ route('cpanel.request_order') }}">
            <i class="fa fa-exchange"></i> <span>Request Order</span>
          </a>
        </li>
        @endif
        @if(session('purchase_order_menu')==1)
        <li class="{{session('active_menu')=='purchase_order'?'active':''}}">
          <a href="{{ route('cpanel.purchase_order') }}">
            <i class="fa fa-tasks"></i> <span>Purchase Order</span>
          </a>
        </li>
        @endif
        @if(session('hutang_supplier_menu')==1)
        <li class="{{session('active_menu')=='hutang_supplier'?'active':''}}">
          <a href="{{ route('cpanel.hutang_supplier') }}">
            <i class="fa fa-money"></i> <span>Hutang Supplier</span>
          </a>
        </li>
        @endif
        @if(session('laporan_po_menu')==1)
        <li class="{{session('active_menu')=='laporan_po'?'active':''}}">
          <a href="{{ route('cpanel.laporan_po') }}">
            <i class="fa fa-table"></i> <span>Laporan PO</span>
          </a>
        </li>
        @endif
        @if(session('atur_user_menu')==1)
        <li class="{{session('active_menu')=='user'?'active':''}}">
          <a href="{{ route('cpanel.user') }}">
            <i class="fa fa-user"></i> <span>Atur User</span>
          </a>
        </li>
        @endif
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>