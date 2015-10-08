<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDataToBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $json = '[
        {"id":1,"name":"\u4e2d\u56fd\u5de5\u5546\u94f6\u884c","status":1,"logo":"gongshang","home":"http:\/\/www.icbc.com.cn","alias":"ICBC","sort":5},
        {"id":2,"name":"\u652f\u4ed8\u5b9d","status":1,"logo":"zhifubao","home":"https:\/\/auth.alipay.com","alias":"ALIPAY","sort":18},
        {"id":3,"name":"\u8d22\u4ed8\u901a","status":1,"logo":"caifutong","home":"http:\/\/www.tenpay.com\/","alias":"TENPAY","sort":19},
        {"id":4,"name":"\u4e2d\u56fd\u519c\u4e1a\u94f6\u884c","status":1,"logo":"nongye","home":"http:\/\/www.abchina.com","alias":"ABC","sort":6},
        {"id":5,"name":"\u4e2d\u56fd\u4ea4\u901a\u94f6\u884c","status":1,"logo":"jiaotong","home":"http:\/\/www.bankcomm.com","alias":"BCM","sort":7},
        {"id":6,"name":"\u4e2d\u56fd\u5efa\u8bbe\u94f6\u884c","status":1,"logo":"jianshe","home":"http:\/\/www.ccb.com","alias":"CCB","sort":8},
        {"id":7,"name":"\u62db\u5546\u94f6\u884c","status":1,"logo":"zhaoshang","home":"http:\/\/www.cmbchina.com\/","alias":"CMB","sort":14},
        {"id":8,"name":"\u4e2d\u56fd\u94f6\u884c","status":1,"logo":"zhongyin","home":"http:\/\/www.boc.cn\/","alias":"BOC","sort":15},
        {"id":9,"name":"\u4e2d\u4fe1\u94f6\u884c","status":1,"logo":"zhongxin","home":"http:\/\/bank.ecitic.com\/","alias":"CCCB","sort":16},
        {"id":10,"name":"\u6d66\u53d1\u94f6\u884c","status":1,"logo":"pufa","home":"http:\/\/www.bankcomm.com","alias":"SPDB","sort":17},
        {"id":11,"name":"\u5e7f\u4e1c\u53d1\u5c55\u94f6\u884c","status":1,"logo":"guangfa","home":"http:\/\/www.cgbchina.com.cn","alias":"GDB","sort":13},
        {"id":12,"name":"\u94f6\u8054\u5728\u7ebf\u652f\u4ed8","status":1,"logo":"yinlian","home":"","alias":"CUP","sort":0},
        {"id":13,"name":"\u534e\u590f\u94f6\u884c","status":1,"logo":"minsheng","home":"http:\/\/www.hxb.com.cn\/","alias":"CMBC","sort":0},
        {"id":14,"name":"\u6613\u5b9d\u652f\u4ed8","status":1,"logo":"huaxia","home":"http:\/\/www.yeepay.com","alias":"HXB","sort":0},
        {"id":15,"name":"\u73af\u8fc5\u652f\u4ed8","status":1,"logo":"pingan","home":"http:\/\/www.ips.com.cn","alias":"SDB","sort":0},
        {"id":16,"name":"\u82b1\u65d7\u652f\u4ed8","status":1,"logo":"huaqi","home":"http:\/\/www.010sms.com\/","alias":"CTB","sort":0},
        {"id":17,"name":"\u4e2d\u56fd\u5149\u5927\u94f6\u884c","status":1,"logo":"guangda","home":"http:\/\/www.cebbank.com","alias":"CEB","sort":10},
        {"id":18,"name":"\u4e2d\u56fd\u90ae\u653f\u94f6\u884c","status":1,"logo":"youzheng","home":"http:\/\/www.psbc.com","alias":"PSBC","sort":11}]';
        $banks = json_decode($json);
        foreach ($banks as $bank) {
            DB::insert('insert into banks (name, status, logo, home_page, alias, sort) values (?, ?, ?, ?, ?,?)', [$bank->name, $bank->status, $bank->logo, $bank->home, $bank->alias, $bank->sort]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
