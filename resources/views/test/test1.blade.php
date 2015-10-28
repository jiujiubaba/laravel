<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="http://cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
	<script src="/asset/js/index-68e3c72.min.js"></script>
	<script src="/asset/js/libs-68e3c72.min.js"></script>
	<link rel="stylesheet" href="/asset/css/libs-68e3c72.min.css">
	<meta name="csrf-token" content="<?php echo csrf_token(); ?>" />
</head>
<body>
	<!-- <form action="/tttt" method="post"> -->
		封顶：<input type="text">
		<!-- <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>"> -->
		<button type="button" id="tj" onclick="tt()">提交</button>
	<!-- </form> -->
</body>
<script>
function tt(){
	$.confirm({
	    title: 'Confirm!',
	    content: 'Simple confirm!',
	    confirm: function(){
	        // alert('Confirmed!');
	    },
	    cancel: function(){
	        // alert('Canceled!')
	    }
	});
}



</script>
</html>