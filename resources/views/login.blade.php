<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('template_admin')}}/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('template_admin')}}/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('template_admin')}}/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('template_admin')}}/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('template_admin')}}/plugins/iCheck/square/blue.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background-image: url('https://i.ytimg.com/vi/jVGAbtq7dBQ/maxresdefault.jpg'); 
    background-size: cover;backdrop-filter: blur(3px); height:80%">
<div class="login-box">
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
  <!-- /.login-logo -->
  <div class="login-box-body">
    <div class="login-logo">
        <img src="https://sribu-sg.s3.amazonaws.com/assets/media/contest_detail/2015/3/desain-logo-untuk-minyak-goreng-barokah-54f6b65f49e20b13c7000007/normal_29daa173f6.jpg" alt="" class="img-responsive img-fluid center-block" width="100px">
    </div>
    <form action="{{route('login.post')}}" method="post">
        @csrf
      <div class="form-group">
        <input type="text" name="username" class="form-control text-center" placeholder="Username">
      </div>
      <div class="form-group">
        <input type="password" name="password" class="form-control text-center" placeholder="Password">
      </div>
      <div class="row">
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary center-block">Login</button>
        </div>
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{asset('template_admin')}}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('template_admin')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
