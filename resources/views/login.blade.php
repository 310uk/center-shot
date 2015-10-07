@extends('master')

@section('title', 'Login')

@section('script')
@stop

@section('content')
<style type="text/css">
    #login {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto;
    }
</style>
<div id="login">
    <a href="{{ $url }}" class="btn-floating btn-large waves-effect waves-light tooltipped indigo lighten-5" id="login" data-position="right" data-delay="50" data-tooltip="CenterShot - Login with Facebook"><img style="vertical-align:middle" src="https://static.xx.fbcdn.net/rsrc.php/yl/r/H3nktOa7ZMg.ico"></a>
</div>
@stop