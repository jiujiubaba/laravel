function changeMoneyToChinese(money) {
    var cnNums = new Array("零", "壹", "贰", "叁", "肆", "伍", "陆", "柒", "捌", "玖");
    var cnIntRadice = new Array("", "拾", "佰", "仟");
    var cnIntUnits = new Array("", "万", "亿", "兆");
    var cnDecUnits = new Array("角", "分", "毫", "厘");
    var cnInteger = "整";
    var cnIntLast = "元";
    var maxNum = 999999999999999.9999;
    var IntegerNum;
    var DecimalNum;
    var ChineseStr = "";
    var parts;
    if (money == "") {
        return "";
    }
    money = parseFloat(money);
    if (money >= maxNum) {
        alert('超出最大处理数字');
        return "";
    }
    if (money == 0) {
        ChineseStr = cnNums[0] + cnIntLast + cnInteger;
        return ChineseStr;
    }
    money = money.toString();
    if (money.indexOf(".") == -1) {
        IntegerNum = money;
        DecimalNum = '';
    } else {
        parts = money.split(".");
        IntegerNum = parts[0];
        DecimalNum = parts[1].substr(0, 4);
    }
    if (parseInt(IntegerNum, 10) > 0) {
        zeroCount = 0;
        IntLen = IntegerNum.length;
        for (i = 0; i < IntLen; i++) {
            n = IntegerNum.substr(i, 1);
            p = IntLen - i - 1;
            q = p / 4;
            m = p % 4;
            if (n == "0") {
                zeroCount++;
            } else {
                if (zeroCount > 0) {
                    ChineseStr += cnNums[0];
                }
                zeroCount = 0;
                ChineseStr += cnNums[parseInt(n)] + cnIntRadice[m];
            }
            if (m == 0 && zeroCount < 4) {
                ChineseStr += cnIntUnits[q];
            }
        }
        ChineseStr += cnIntLast;
    }
    if (DecimalNum != '') {
        decLen = DecimalNum.length;
        for (i = 0; i < decLen; i++) {
            n = DecimalNum.substr(i, 1);
            if (n != '0') {
                ChineseStr += cnNums[Number(n)] + cnDecUnits[i];
            }
        }
    }
    if (ChineseStr == '') {
        ChineseStr += cnNums[0] + cnIntLast + cnInteger;
    } else if (DecimalNum == '') {
        ChineseStr += cnInteger;
    }
    return  ;
}

function formatFloat(num) {
    num = num.replace(/^[^\d]/g, '');
    num = num.replace(/[^\d.]/g, '');
    num = num.replace(/\.{2,}/g, '.');
    num = num.replace(".", "$#$").replace(/\./g, "").replace("$#$", ".");
    if (num.indexOf(".") != -1) {
        var data = num.split('.');
        num = (data[0].substr(0, 15)) + '.' + (data[1].substr(0, 1));
    } else {
        num = num.substr(0, 15);
    }
    return num;
}

function moneyFormat(num) {
    var v = num;
    sign = Number(num) < 0 ? "-" : "";
    num = num.toString();
    if (num.indexOf(".") == -1) {
        num = "" + num + ".00";
    }
    var data = num.split('.');
    if (data[1].length == 0) {
        return sign + "" + data[0] + ".0";
    } else {
        return v;
    }
}

function copyToClipboard(obj) {
    txt = jQuery("#" + obj).html();
    alert(txt);
    if (window.clipboardData) {
        window.clipboardData.clearData();
        window.clipboardData.setData("Text", txt);
    } else if (navigator.userAgent.indexOf("Opera") != -1) {
        window.location = txt;
    } else if (window.netscape) {
        try {
            netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
        } catch (e) {
            alert("您的firefox安全限制限制您进行剪贴板操作，请在地址栏中输入“about:config”将“signed.applets.codebase_principal_support”设置为“true”之后重试");
            return false;
        }
        var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);
        if (!clip)
            return;
        var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);
        if (!trans)
            return;
        trans.addDataFlavor('text/unicode');
        var str = new Object();
        var len = new Object();
        var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);
        var copytext = txt;
        str.data = copytext;
        trans.setTransferData("text/unicode", str, copytext.length * 2);
        var clipid = Components.interfaces.nsIClipboard;
        if (!clip)
            return false;
        clip.setData(trans, null, clipid.kGlobalClipboard);
    }
}
