<!DOCTYPE html>
<html lang="en">

<head>
    <title>用户中心</title>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- 图标插件 -->
    <link href="http://cdn.bootcss.com/font-awesome/3.1.1/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://cdn.bootcss.com/font-awesome/3.1.1/font/fontawesome-webfont.svg">
    
    <!-- css公共样式 -->
    <link rel="stylesheet" href="/asset/css/common-68e3c72.min.css">
    <link rel="stylesheet" href="/asset/css/index-68e3c72.min.css">
    <link rel="stylesheet" href="/asset/css/ucenter-68e3c72.min.css">

    <!-- 自定义样式 -->
    @yield('style')

    <!-- 公用js -->
    <script src="/asset/js/jquery.min.js"></script>

</head>
<body style="background:#fff">
@yield('content')
</body>
<script src="/asset/js/common-68e3c72.min.js"></script>
<script src="/asset/js/data-68e3c72.min.js"></script>
@yield('scripts')
</html>
