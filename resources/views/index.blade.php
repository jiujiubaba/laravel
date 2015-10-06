@extends('layouts.base')

@section('content')
asdfasdf
<script src="/asset/js/plugins.js"></script>
<script>
$('#bt').modal(function(){
    var a= $('#J-form-banks').serialize();
    $.post('/banks/add', a, function(data){
        console.log(a);
    }); 

});
$.tooltip('asdfasdf');
</script>
@stop


