@extends('layouts.ucenter')

@section('content')
<div class="common-info clearfix">
    <h4 class="content-title">银行充提</h4>
    <ul class="content-nav clearfix">
        <li class="current"><a href="/banks">网银转账</a></li>
        <li ><a href="/banks/withdraw">提现</a></li>
        <li ><a href="/banks/withdraw-record">提现记录</a></li>
        <li ><a href="/banks/recharge-record">充值记录</a></li>
    </ul>
</div>
<div class="table-area"> 
    <form method="post" target="" onsubmit="return backurl()">
        <h4 class="ui-form-title mt20">确认<span style=" color:#ea6b6c; font-weight:bold">转账</span></h4>
        <div class="ui-content mt20">
            <ul id="ap_title" class="ap_ul">
                <li class="wid">收款账户名</li>
                <li class="wid">收款银行</li>
                <li style="width:206px;"> 收款卡号</li>
                <li class="wid">金额</li>
                <li class="wid">开户地址</li>
                <li class="wid" style="font-size:13px;">附言</li>
            </ul>
            <ul id="ap_content" class="ap_ul">
                <li class="wid"><span id="cp1">{{ $bank->name }}</span> </li>
                <li class="wid">
                    招商银行
                </li>
                <li style="width:206px;"><span id="cp2">{{ $bank->account }}</span> </li>
                <li class="wid"><span id="cp3">{{$bank->money}}</span> </li>
                <li class="wid"><span id="cp4">{{ $bank->address }}</span> </li>
                <li class="wid"><span id="cp5" style="color:#00F;font-size:13px">{{ $bank->remark }}</span> </li>
            </ul>
            <input type="hidden" name="bank" value="{{ $bank->alias }}">
            <input type="hidden" name="money" value="{{ $bank->money }}">
            <input type="hidden" name="rand" value="{{ $bank->remark }}">
            <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
            <div class="mt10  text-center" id="fastSure">
                <button type="button" class="ui-btn important-nothumb no-bg-img mt30" onclick="backurl()">确认，并转到网银支付</button>
                <!-- <a href="#" class="white btn important-nothumb no-bg-img mt30" style="background-color:#999"><span id="remaining_time_fast"></span>附言将过期</a>
                
                <a href="/?mod=safe&amp;code=rechargelist&amp;type=recharge" class="timing_ctrl mt30" style="color:#933;margin-left:20px; margin-right:10px;text-decoration: underline;">完成并查看记录</a>
                <a href="/?mod=safe&amp;code=flashpay&amp;rem=set" class="timing_ctrl mt30" style="color:#933;text-decoration: underline;">再存一笔</a> -->
            </div>
        </div>
    </form>
    <div class="dashed mt30" align="left">
        <h4 class="title">操作步骤</h4>
        <p>1. 请您点击
            <font color="#FF0000">确认，并转到银行支付</font>按钮，登陆工商银行 www.icbc.com.cn，点击左侧个人网银用户；</p>
        <p>2. 输入帐号和密码进行登录，点击“转账汇款”按钮；</p>
        <p>3. 输入此页面提供的收款人姓名、账号、金额、附言转账信息；</p>
        <p>4. 附言输入步骤请（点击网站的网银转账页面，选择银行输入转账金额，下一步后自动获取转账信息和附言）将页面提供的附言复制到银行转账页面的附言里，点击确定转账成功即可。</p>
    </div>
    <div class="dashed mt30" align="left">
        <h4 class="title">注意事项</h4>
        <p>1. 一个附言只用于一次转账，60分钟内有效，多笔转账请重新提交，确定，完成支付，两分钟内您可以查到该笔转账的记录；</p>
        <p>2. 网银转账支持 工商银行、农业银行、中国银行、建设建行、招商银行、交通银行、广发银行 转账；</p>
        <p>3. 附言写错或忘写附言，请把您的登录账户及该笔转账回单的完整截图提交给客服人员处理，处理成功立即上分；</p>
        <p>4. 如有疑问，请联系在线客服。</p>
    </div>
</div>
@stop

@section('scripts')
<script language="javascript">


function backurl(){
    window.open("{{ $bank->home_page }}");
    return true;
}
var tr;
function timer(y,m,d,h,i,s)  
{  
    clearInterval(tr);
    var ts = (new Date(y, m, d, h, i, s)) - (new Date());//计算剩余的毫秒数    
    var mm = parseInt(ts / 1000 / 60 % 60, 10);//计算剩余的分钟数  
    var ss = parseInt(ts / 1000 % 60, 10);
    mm = checkTime(mm);  
    ss = checkTime(ss);  
    document.getElementById("remaining_time_fast").innerHTML =  mm +"分"+ss+'秒'; 
    console.log(mm +"分"+ss+'秒'); 
    tr = setInterval("timer("+y+", "+m+", "+d+", "+h+", "+i+", "+s+")",1000);  
}  
function checkTime(i)    
{    
   if (i < 10) {    
       i = "0" + i;    
    }    
   return i;    
}
 
timer(2015,10,09,07,17,52);
 
                

</script>
@stop