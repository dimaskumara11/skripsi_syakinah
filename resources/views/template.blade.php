<!DOCTYPE html>
<html>

@include('template.head')

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include('template.navbar')
  <!-- Left side column. contains the logo and sidebar -->
  @include('template.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        @if(!empty(session("status")))
        <div class="alert alert-{{session("status")=="error"?"danger":"success"}} w-100">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {{session("message")}}
        </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2020-2021 All rights reserved.
  </footer>
</div>
@include('template.footer')
</body>
</html>
