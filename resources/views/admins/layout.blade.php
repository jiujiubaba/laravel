<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="http://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
  <link href="http://cdn.bootcss.com/font-awesome/4.0.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/asset/css/main.css">
	<script src="http://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="/asset/js/dropdown.js"></script>

</head>
<body>
<header>
<div class="container-fluid w1000">
    <div class="navbar-header">
        <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-example-js-navbar-collapse">
		    <span class="sr-only">Toggle navigation</span>
		    <span class="icon-bar"></span>
		    <span class="icon-bar"></span>
		    <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Project Name</a>
    </div>
    <div class="collapse navbar-collapse bs-example-js-navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="dropdown">
            	<a id="drop1" href="#" class="dropdown-toggle topbar_cont" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                	Dropdown <span class="caret"></span>
              	</a>
	            <ul class="dropdown-menu" aria-labelledby="drop1">
	                <li><a href="#">Action</a></li>
	                <li><a href="#">Another action</a></li>
	                <li><a href="#">Something else here</a></li>
	            </ul>
            </li>
            <li class="dropdown">
              	<a id="drop2" href="#" class="dropdown-toggle topbar_cont" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                	Dropdown <span class="caret"></span>
              	</a>
              	<ul class="dropdown-menu" aria-labelledby="drop2">
	                <li><a href="#">Action</a></li>
	                <li><a href="#">Another action</a></li>
	                <li><a href="#">Something else here</a></li>
              	</ul>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li id="fat-menu" class="dropdown">
              	<a id="drop3" href="#" class="dropdown-toggle topbar_cont" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                	Dropdown <span class="caret"></span>
              	</a>
              	<ul class="dropdown-menu" aria-labelledby="drop3">
	                <li><a href="#">Action</a></li>
	                <li><a href="#">Another action</a></li>
	                <li><a href="#">Something else here</a></li>
              	</ul>
            </li>
        </ul>
    </div>
</div>
</header>



@yield('content')
</body>
<script>
$('.dropdown-toggle').dropdown()
</script>
<script src="/asset/js/main.js"></script>
</html>