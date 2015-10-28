<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="/asset/css/common-68e3c72.min.css">

	<link rel="stylesheet" href="/asset/css/libs-68e3c72.min.css">
	<script src="http://cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
	<script src="/asset/js/index-68e3c72.min.js"></script>
	<script src="/asset/js/libs-68e3c72.min.js"></script>

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
	    title: '提示!',
	     content: 'Imagine this is a complex form and you have to attach events all over the form or any element <br><button type="button" class="examplebutton">I\'m alive!</button>',
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