<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>首页</title>
    <meta name="viewport" content="width=device-width,target-densitydpi=high-dpi,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link href="http://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://cdn.bootcss.com/font-awesome/3.1.1/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/asset/css/common.css">
    <link rel="stylesheet" href="/asset/css/index.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/font-awesome/3.1.1/font/fontawesome-webfont.svg">

    <style>
html{
	width: 100%;
	height: 100%;
}

body{
	width: 100%;
	height: 100%;
	min-height: 700px;
	background: url(../images/newtpl/body-bg.jpg) no-repeat center center fixed;
}

.bg-area-after{
	width: 100%;
	height: 100%;
	opacity: 1;
	background: url(../images/newtpl/index_bg.jpg) no-repeat center center;
	background-size: 1920px 1024px;
	-webkit-transition: all 1s ease 0.3s, opacity 1.5s ease 0.5s;
	   -moz-transition: all 1s ease 0.3s, opacity 1.5s ease 0.5s;
	     -o-transition: all 1s ease 0.3s, opacity 1.5s ease 0.5s;
	        transition: all 1s ease 0.3s, opacity 1.5s ease 0.5s;
}

.success .bg-area-after{
	opacity: 0;
	background-size: 2920px 2024px;
}

.bg-area{
	position: relative;
	width: 100%;
	height: 100%;
	opacity: 1;
	background: url(../images/newtpl/log-bg.png?t=00809808709) no-repeat center center;
	background-size: 600px 636px;
	-webkit-transition: all 0.5s ease, opacity 0.5s ease;
	   -moz-transition: all 0.5s ease, opacity 0.5s ease;
	     -o-transition: all 0.5s ease, opacity 0.5s ease;
	        transition: all 0.5s ease, opacity 0.5s ease;
}

.success .bg-area{
	opacity: 0;
	background-size: 1000px 1000px;
}

.login-area{
	width: 330px;
	position:relative;
	height: 200px;
	text-align: center;
	margin:50px auto 0;
}

.slogan{
	color: #fff;
	font-size: 14px;
}

.login-area .user-name,
.login-area .user-password,
.login-area .user-name,

.login-area .user-nick,
.login-area .user-xx,

.login-area .user-login-button{
	width: 330px;
	height: 50px;
	margin: 0 auto;
	line-height: 50px;
	color: #75797b;
	float:left;
}

.form-data-code{
  width: 100%;
  height: 35px;
  line-height: 35px;
  outline: none;
  font-size: 18px;
}

.user-code{
	width: 200px;
	height: 50px;
	margin: 0 5px 0 0;
	line-height: 50px;
	float:left;
	color: #75797b;
}

.login-area .user-nick,
.login-area .user-xx,
.login-area .user-name,
.login-area .user-code,
.login-area .user-password{
	padding: 0 15px;
	border: none;
	background: #f2f2f2;
}

.login-area .user-password{
	/*border-top: 1px solid #fff;
	border-radius: 0 0 5px 5px ;*/
}

.login-area .user-login-button{
	width: 330px;
	border: none;
	background: #f27272;
	cursor: pointer;
	letter-spacing: 0.5em;
	color: #fff;
	-webkit-transition: background 0.3s ease-in;
	   -moz-transition: background 0.3s ease-in;
	     -o-transition: background 0.3s ease-in;
	        transition: background 0.3s ease-in;
}

.login-area .user-login-button:hover{
	background: #ff7979;
}

.login-loading{
	display: none;
	position: absolute;
	top: 0;
	left: 0;
	width: 350px;
	height: 100%;
	margin-left:-10px;
	background: #fff;	
	z-index: 1;
}

.login-loading .thumb{
	height: 60px;
	margin: 60px 0 0 0;
	background: url(../images/newtpl/loading.gif) no-repeat center center;
}

.login-loading .text{
	margin: 20px 0 0 0;
	color: #3d4851;
	text-align: center;
}

.login-info{
	overflow: hidden;
}

.login-info .bg-area{
	width: 804px;
	height: 668px;
	margin: 30px auto 0 auto;
	background: none;
}

.login-info .header{
	width: 804px;
	height: 226px;
	background: url(../images/newtpl/login-info_03.png) no-repeat 0 0;
}

.login-info .content{
	width: 804px;
	height: 366px;
	background: url(../images/newtpl/login-info_06.png) repeat-y 0 0;
}

	.rules-content{
		width: 545px;
		height: 306px;
		padding: 10px 15px;
		overflow: auto;
		margin: 0 auto;
		color: #888;
		line-height: 2em;
	}

	.login-info .content a{
		width: 130px;
		height: 50px;
		line-height: 50px;
		font-size: 16px;
	}

	.login-info .content .btn-important{
		color: #fff;
	}

	.login-info .content .btn-default:hover{
		background-color: #f1f1f1;
	}

	.login-info .reg-success{
		line-height: 35px;
	}

	.login-info .reg-success p{
		font-size: 34px;
	}

.login-info .bottom{
	width: 804px;
	height: 138px;
	background: url(../images/newtpl/login-info_08.png) repeat-y 0 0;
}
	


	.register{
		min-height: 830px;
	}

	.register div.input{
		height: 45px;
		margin: 10px 0 0 0;
		padding-left: 15px;
		line-height: 45px;
		color: #3d4851;
		font-size: 16px;
	}

		.register div.input input{
			width: 220px;
			height: 40px;
			margin-left: 20px;
			border: none;
			background: none;
			font-size:14px;
			outline: none;
		}

		.register .desc{
			height: 0px;
			margin: 0;
			line-height: 40px;
			font-size: 12px;
		}

		.register .content{
			height: 450px;
		}

		.register .rules-content{
			height: 390px;
		}

		.register  #J-register-button{
			width: 150px;
			height: 45px;
			line-height: 45px;
			border: none;
			text-align: center;
		}

    </style>

    <script src="http://cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>

<body style="background:url(http://999.niucaivip.com/tpl/black//images/newtpl/dl_07.jpg) no-repeat bottom center fixed #fff; height:830px;">
    <div style="background:#d45656; height:20px; width:100%;">&nbsp;</div>
    <div style="background:url(http://999.niucaivip.com/tpl/black//images/newtpl/dl_03.png); width:462px; height:69px; margin:100px auto 0;">&nbsp;</div>
     <input type="hidden" id="md" value="1">
     <div class="login-area">
    <div id="form1">
    <form id="J-form-login1" action="#" target="#">
        <div style="clear:both; height:62px;">
        <input type="text" name="username" class="user-name" value="" placeholder="用户名" autocomplete="off" title="用户名">
        </div>
         <div style="clear:both; height:62px;">
        <input type="password" name="passwd" class="user-name" value="" placeholder="密码" autocomplete="off" title="密码">
        </div>
        <div style="clear:both; height:62px;">
        <input type="text" name="user-code" class="user-code form-data-code" value="" placeholder="验证码" autocomplete="off" title="验证码" maxlength="4">
        <img id="ck" src="{{ captcha_src() }}" style="cursor:pointer;float:right;" onclick="this.src='{{ captcha_src() }}'" 
        align="absbottom" title="点击刷新"></div>
        <input type="hidden" name="nextGo" value="AJAX">
        <div style="clear:both; height:62px;"><input type="submit" class="user-login-button disabled sub" value="登录"></div> 
    </form>
    </div>
	<div style="margin:10px auto; clear:both; text-align:center; color:#adadad; font-size:12px;">为了避免假冒nncny的站点偷窃您的用户名和密码，我们采用新的登录方式以保证您的账户安全</div>
        <div style="font-size:12px; text-align:center;"><a href="javascript:void(0)" onclick="showGetPas()" style=" color:#C30; margin-right:20px; ">忘记密码</a></div>
    <a href="http://se.360.cn/" target="_blank" style="display:none">360安全浏览器</a>
 </body>
<script src="/js/index.js"></script>
<script>
$();
</script>
</html>

