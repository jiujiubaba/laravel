<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>我的账户</title>
    <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
    <link href="http://cdn.bootcss.com/font-awesome/3.1.1/css/font-awesome.min.css" rel="stylesheet">
    @yield('style')
    <!-- css公共样式 -->
    <link rel="stylesheet" href="/asset/css/common.css">
    <link rel="stylesheet" href="/asset/css/index.css">
    <link rel="stylesheet" href="/asset/css/ucenter.css">
    <link rel="stylesheet" href="/asset/css/sweet-alert.css">
    <link rel="stylesheet" href="/asset/css/plugins.css">
    
    <!-- css动画插件 -->
    <!-- <link rel="stylesheet" href="/asset/css/animate.min.css"> -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/font-awesome/3.1.1/font/fontawesome-webfont.svg">
    <script src="/asset/js/jquery.min.js"></script>
    <script src="/asset/js/sweet-alert.js"></script>
    <script src="/asset/js/tools.js"></script>
    
</head>

<body>
<div class="notice_wrap">
 <div class="notice">
    <span onclick="topUrlGo('/?mod=help&amp;code=noticelist',this)" class="icon-volume-up laba" title="查看公告">&nbsp;</span>
        <marquee class="layout f-left" id="notice" onmouseover="this.stop()" onmouseout="this.start();" style="width:750px; color:#fff;"><a href="javascript:void(0)" onclick="opnotice(94)">1:关于纽约彩种升级维护;</a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="opnotice(93)">2:关于中国银行维护;</a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="opnotice(92)">3:豪礼iPhone6 plus ，新款iPhone6s大放送！;</a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="opnotice(91)">4:关于农业银行维护;</a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="opnotice(89)">5:金秋十月迎国庆,牛彩任性就发RMB;</a>&nbsp;&nbsp;</marquee>
        <ul class="f-right head-nav" style="margin-right:20px;">
            <li class="online">
                <a href="javascript:void(0)" onclick="javascript: window.open('http://chat32.live800.com/live800/chatClient/chatbox.jsp?companyID=487194&amp;jid=2239530169','','menubar=no,status=yes,scrollbars=yes,top=150')">
                <i class="icon-headphones mr10"></i>在线客服</a>
            </li>
            <li class="bet white">
                <a href="download/pc.html" target="_blank"><i class="icon-cloud-download mr10"></i>下载中心</a>
            </li>
            <li class="exit white">
            <a href="/logout" class="quit"><i class="icon-off mr10"></i>退出</a>
            </li>
       </ul>
    </div>   
</div>

<div class="nav">
    <div class="layout">
        <div class="logo">
        </div>
        <ul class="nav-list" id="nav-list">
            <li class="">
                <a href="/account">我的帐户</a>
            </li>
            <li class="bank">
                <a href="/banks">银行充提</a>
            </li>
            <li class="bethistory">
                <a href="/">投注记录</a>
            </li>
            <li class="repory">
                <a href="#">帐户报表</a>
            </li>
            <li class="proxy">
                <a href="/agent">代理管理</a>
            </li>
            <li class="culture">
                <a href="/team">团队管理</a>
            </li>
            <li class="activity">
                <a href="/integral">积分商城</a>
            </li>
        </ul>
    </div>
</div>

    <div class="content layout">
        <div class="sidebar" id="sidebar">
            <div class="user-info">
                <div class="user-level-info">
                    <div>
                        <a href="javascript:void(0)" class="user-name white">{{ Auth::user()->nickname }}</a>
                        <span class="mark" href="javascript:void(0)">vip{{Auth::user()->level}}</span>
                    </div>
                    <div class="process">
                        <div class="current-process" style="width:20%"></div>
                    </div>
                </div>
                <div class="balance">
                    <span>余额：</span>
                    <em id="lostmoney">{{ Auth::user()->cash }}</em> 元
                    <a href="javascript:void(0)" title="刷新余额" class="refresh"><i class="icon-refresh"></i></a>
                </div>
                <div class="control">
                    <a href="javascript:void(0)" onclick="topUrlGo('/?mod=safe&amp;code=recharge',this)" class="btn btn-default">充 值</a>
                    <a href="javascript:void(0)" onclick="topUrlGo('/?mod=safe&amp;code=platform',this)" class="btn btn-default">提 款</a>
                </div>
            </div>
            <div class="leftmenu2">
                <ul class="lottery-list" id="lottery-list">
                    <li id="s-NYYFC">
                        <a class="name" href="javascript:void(0)">纽约一分彩</a> <a href="javascript:void(0)" class="desc">一分钟一期</a>
                        <img style="margin:8px 0" src="http://999.niucaivip.com/tpl/black/images/newtpl/fire.png"> </li>
                    <li id="s-NYSFC">
                        <a class="name" href="javascript:void(0)">纽约三分彩</a> <a href="javascript:void(0)" class="desc">三分钟一期</a>
                        <img style="margin:8px 0" src="http://999.niucaivip.com/tpl/black/images/newtpl/fire.png"> </li>
                    <li id="s-NYWFC">
                        <a class="name" href="javascript:void(0)">纽约五分彩</a> <a href="javascript:void(0)" class="desc">五分钟一期</a>
                        <img style="margin:8px 0" src="http://999.niucaivip.com/tpl/black/images/newtpl/fire.png"> </li>
                    <li id="s-CQSSC" class="current">
                        <a class="name" href="javascript:void(0)">重庆时时彩</a> <a href="javascript:void(0)" class="desc">最热门彩种</a>
                        <img style="margin:8px 0" src="http://999.niucaivip.com/tpl/black/images/newtpl/fire.png"> </li>
                    <li id="s-JXSSC">
                        <a class="name" href="javascript:void(0)">江西时时彩</a>
                        <a href="javascript:void(0)" class="desc"></a>
                    </li>
                    <li id="s-XJSSC">
                        <a class="name" href="javascript:void(0)">新疆时时彩</a>
                        <a href="javascript:void(0)" class="desc"></a>
                    </li>
                    <li id="s-TJSSC">
                        <a class="name" href="javascript:void(0)">天津时时彩</a>
                        <a href="javascript:void(0)" class="desc"></a>
                    </li>
                    <li id="s-JSK3">
                        <a class="name" href="javascript:void(0)">江苏快3</a>
                        <a href="javascript:void(0)" class="desc"></a>
                    </li>
                    <li id="s-BJPK10">
                        <a class="name" href="javascript:void(0)">北京赛车</a>
                        <a href="javascript:void(0)" class="desc"></a>
                        <img style="margin:8px 0" src="http://999.niucaivip.com/tpl/black/images/newtpl/fire.png"> </li>
                    <li id="s-BJKL8">
                        <a class="name" href="javascript:void(0)">北京快乐8</a> <a href="javascript:void(0)" class="desc">返奖率高</a>
                    </li>
                    <li id="s-GDKLSF">
                        <a class="name" href="javascript:void(0)">广东快乐十分</a>
                        <a href="javascript:void(0)" class="desc"></a>
                    </li>
                    <li id="s-NY11-5">
                        <a class="name" href="javascript:void(0)">纽约11选5</a>
                        <a href="javascript:void(0)" class="desc"></a>
                    </li>
                    <li id="s-SD11-5">
                        <a class="name" href="javascript:void(0)">山东11选5</a> <a href="javascript:void(0)" class="desc">玩法多样</a>
                    </li>
                    <li id="s-GD11-5">
                        <a class="name" href="javascript:void(0)">广东11选5</a>
                        <a href="javascript:void(0)" class="desc"></a>
                    </li>
                    <li id="s-JX11-5">
                        <a class="name" href="javascript:void(0)">江西11选5</a>
                        <a href="javascript:void(0)" class="desc"></a>
                    </li>
                    <li id="s-3D">
                        <a class="name" href="javascript:void(0)">福彩3D</a>
                        <a href="javascript:void(0)" class="desc"></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content-info clearfix bet-panel">
         @yield('content')
        </div>
        
    </div>
</body>
<!-- <script src="./js/index.js"></script> -->
@yield('scripts')
</html>
