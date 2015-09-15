<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form method="post" action="/index">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <img src="{{ captcha_src() }}" alt="">
        <p><input type="text" name="captcha"></p>
        <p><button type="submit" name="check">Check</button></p>
        </form>
</body>
</html>