@extends('admins.layout')
@section('content')
<div class="container w1000">
<div class="btn-group" role="group" aria-label="...">
	<div class="btn-group" role="group">
	    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	      	<i class="glyphicon glyphicon-font"></i> <span class="caret"></span>
	    </button>
	    <ul class="dropdown-menu">
	      	<li><a href="#">Dropdown link</a></li>
	      	<li><a href="#">Dropdown link</a></li>
	    </ul>
	</div>
  	<button type="button" class="btn btn-default"><i class="glyphicon glyphicon-bold"></i></button>
  	<button type="button" class="btn btn-default"><i class="glyphicon glyphicon-italic"></i></button>
  	<div class="btn-group" role="group">
	    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	      	<i class="glyphicon glyphicon-text-height"></i>i <span class="caret"></span>
	    </button>
	    <ul class="dropdown-menu">
	      	<li><a href="#">Dropdown link</a></li>
	      	<li><a href="#">Dropdown link</a></li>i
	    </ul>
	</div>
  	<button type="button" class="btn btn-default"><i class="glyphicon glyphicon-align-left"></i></button>
  	<button type="button" class="btn btn-default"><i class="glyphicon glyphicon-align-center"></i></button>
  	<button type="button" class="btn btn-default"><i class="glyphicon glyphicon-align-right"></i></button>
  	<button type="button" class="btn btn-default"><i class="glyphicon glyphicon-list"></i></button>
  	<button type="button" class="btn btn-default"><i class="glyphicon glyphicon-indent-left"></i></button>
  	<button type="button" class="btn btn-default"><i class="glyphicon glyphicon-indent-right"></i></button>
  	<button type="button" class="btn btn-default"><i class="glyphicon glyphicon-text-color"></i></button>
  	<button type="button" class="btn btn-default"><i class="glyphicon glyphicon-text-background"></i></button>
  	<button type="button" class="btn btn-default"><i class="glyphicon glyphicon-link"></i></button>
  	<button type="button" class="btn btn-default"><i class="glyphicon glyphicon-paperclip"></i></button>
  	<button type="button" class="btn btn-default"><i class="glyphicon glyphicon-picture"></i></button>
  	<button type="button" class="btn btn-default"><i class=""></i></button>
  	<button type="button" class="btn btn-default"><i class=""></i></button>
</div>
<div id="editors">



</div>
</div>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<script src="/asset/js/editors.js"></script>
@stop