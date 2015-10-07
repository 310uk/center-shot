@extends('master')

@section('title', '')

@section('js')
    <script src="./js/ajax.js"></script>
@stop

@section('script_ready')
    alert($.title());
@stop

@section('script_other')
@stop

@section('content')


<p><a href="/logout">ログアウト</a></p>
@stop