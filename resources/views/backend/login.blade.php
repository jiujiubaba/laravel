<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>登录</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="/admin/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link href="//cdn.bootcss.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Ionicons -->
    <!-- Theme style -->
    <link rel="stylesheet" href="/admin/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="/admin/css/skins/skin-blue.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="//cdn.bootcss.com/html5shiv/3.7.3/html5shiv-printshiv.min.js"></script>
        <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    

    <!-- jQuery 2.1.4 -->
    <script src="/admin/js/jquery.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="/admin/js/bootstrap.min.js"></script>
    <style>
    .login-page, .register-page{
          background-color: transparent;
          background-image: url("{{ $url }}");
          background-attachment: fixed;
          background-position: top center;
          background-repeat: no-repeat;
          background-size: cover;
          position: absolute;
          top: 0;
          bottom: 0;
          left: 0;
          right: 0;
    }
    </style>
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="../../index2.html"><b>Admin</b>LTE</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form id="f-login" >
          <div class="input-group has-feedback" style="margin-bottom:15px;">
            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
            <input type="text" name="username" class="form-control" placeholder="用户名">
          </div>
          <div class="input-group has-feedback" style="margin-bottom:15px;">
            <span class="input-group-addon" style="font-size: 20px;"><i class="fa fa-lock"></i></span>
            <input type="password" name="password" class="form-control" placeholder="密码">
          </div>
          <div class="input-group has-feedback" style="margin-bottom:15px;">
            <input type="text" name="vcode" class="form-control" placeholder="验证码" style="width:218px;margin-right:20px;">
            <img id="ck" style="height:34px;" src="{{ captcha_src() }}" style="cursor:pointer;float:right;" onclick="this.src='{{ captcha_src() }}'" 
            align="absbottom" title="点击刷新">
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="checkbox icheck">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <button type="button" class="btn btn-primary btn-block btn-flat" id="submit" >登  录</button>
              </div>
            </div><!-- /.col -->
          </div>
        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
  </body>
  <script>
  $(function(){
    $('#ck').click(function(event) {
      var _this = $(this);
      $.get('/getCode',function(data){
        _this.attr('src', data);
      });
    });

    $('#submit').click(function(){
      var t = $('#f-login').serialize();
      $.post('/backend/check', t, function(data){
        if (data.result) {
          window.location.href = '/backend/';
        }else{
          console.log(data.message);
        }
      });
    });

  });
  </script>
</html>
