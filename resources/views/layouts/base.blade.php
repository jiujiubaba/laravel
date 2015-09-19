<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>我的账户</title>
    <meta name="viewport" content="width=device-width,target-densitydpi=high-dpi,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link href="http://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://cdn.bootcss.com/font-awesome/3.1.1/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/asset/css/common.css">
    <link rel="stylesheet" href="/asset/css/index.css">
    <link rel="stylesheet" href="/asset/css/ucenter.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/font-awesome/3.1.1/font/fontawesome-webfont.svg">
    <script src="http://cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>

<body>
<div class="nav">
    <div class="layout">
        <div class="logo">
        </div>
        <ul class="nav-list" id="nav-list">
            <li class="">
                <a href="#">我的帐户</a>
            </li>
            <li class="bank">
                <a href="#">银行充提</a>
            </li>
            <li class="bethistory">
                <a href="#">投注记录</a>
            </li>
            <li class="repory">
                <a href="#">帐户报表</a>
            </li>
            <li class="proxy">
                <a href="#">代理管理</a>
            </li>
            <li class="activity">
                <!-- onClick="('/?mod=a)"-->
                <a href="#" target="_blank">优惠活动</a>
            </li>
            <li class="culture">
                <a href="#">企业文化</a>
            </li>
            <li class="helpcenter">
                <a href="#">真人娱乐</a>
            </li>
        </ul>
    </div>
</div>

    <div class="content layout">
        <div class="sidebar" id="sidebar">
            <div class="user-info">
                <div class="user-level-info">
                    <div>
                        <a href="javascript:void(0)" class="user-name">赵四</a>
                        <span class="mark" href="javascript:void(0)">vip1</span>
                    </div>
                    <div class="process">
                        <div class="current-process" style="width:20%"></div>
                    </div>
                </div>
                <div class="balance">
                    <span>余额：</span>
                    <em id="lostmoney">0</em> 元
                    <a href="javascript:void(0)" title="刷新余额" class="refresh"><i class="icon-refresh"></i></a>
                </div>
                <div class="control">
                    <a href="javascript:void(0)" onclick="topUrlGo('/?mod=safe&amp;code=recharge',this)" class="btn btn-default">充 值</a>
                    <a href="javascript:void(0)" onclick="topUrlGo('/?mod=safe&amp;code=platform',this)" class="btn btn-default">提 款</a>
                </div>
            </div>
            <div class="leftmenu2">
                <ul class="lottery-list" id="lottery-list">
                    <li>
                        <a class="name" href="javascript:void(0)">纽约秒秒彩</a> <a href="javascript:void(0)" class="desc">即开型</a>
                        <img style="margin:8px 0" src="http://999.niucaivip.com/tpl/black/images/newtpl/fire.png"> </li>
                    <li id="s-NYYFC">
                        <a class="name" href="javascript:void(0)">纽约一分彩</a> <a href="javascript:void(0)" class="desc">一分钟一期</a>
                        <img style="margin:8px 0" src="http://999.niucaivip.com/tpl/black/images/newtpl/fire.png"> </li>
                    <li id="s-NYSFC">
                        <a class="name" href="javascript:void(0)">纽约三分彩</a> <a href="javascript:void(0)" class="desc">三分钟一期</a>
                        <img style="margin:8px 0" src="http://999.niucaivip.com/tpl/black/images/newtpl/fire.png"> </li>
                    <li id="s-NYWFC">
                        <a class="name" href="javascript:void(0)">纽约五分彩</a> <a href="javascript:void(0)" class="desc">五分钟一期</a>
                        <img style="margin:8px 0" src="http://999.niucaivip.com/tpl/black/images/newtpl/fire.png"> </li>
                    <li id="s-NY3D">
                        <a class="name" href="javascript:void(0)">纽约3D</a>
                        <a href="javascript:void(0)" class="desc"></a>
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
                    <li id="s-P5(P3)">
                        <a class="name" href="javascript:void(0)">P5(P3)</a>
                        <a href="javascript:void(0)" class="desc"></a>
                    </li>
                    <li><a class="name" href="javascript:void(0)">双色球</a> <a href="javascript:void(0)" class="desc">即将上线</a></li>
                    <li><a class="name" href="javascript:void(0)">大乐透</a> <a href="javascript:void(0)" class="desc">即将上线</a></li>
                    <li onclick="winGo('http://999.niucaivip.com/?mod=game&amp;code=cas',this)" id="s-P5(P3)"><a class="name" href="javascript:void(0)">真人娱乐</a>
                        <a href="javascript:void(0)" class="desc"></a>
                    </li>
                    <li><a class="name" href="javascript:void(0)">电子游戏</a> <a href="javascript:void(0)" class="desc">待上线</a></li>
                    <li><a class="name" href="javascript:void(0)">斗地主</a> <a href="javascript:void(0)" class="desc">待上线</a></li>
                </ul>
            </div>
        </div>
        <div class="content-info clearfix bet-panel">
         @yield('content')
        </div>
        
    </div>
</body>
<script src="./js/index.js"></script>

</html>
