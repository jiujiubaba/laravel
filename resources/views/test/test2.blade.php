<div>
	test
	<button class="ui-btn" id="tttt" onclick="tt()">是打发</button>

</div>
<script>
function tt(){
	window.parent.$.alert({
	    title: 'Alert!',
	    content: 'sdfasdfasfa',
	    confirm: function(){
	        // console.log($('#tttt').html());
	    }
	});
}

</script>