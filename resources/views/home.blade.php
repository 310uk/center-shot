@extends('master')

@section('title', 'Home')

@section('js')
    <script src="./js/ajax.js"></script>
@stop

@section('script_ready')
        //begun_from
        var str_dt = '{{ date_format(date_create(\Auth::user()->begun_from), "Y/m/d") }}';

        //play
        $("button").click(function() {
            if (!confirm($(this).text() + "で練習を開始します。")) return;
            var value = $(this).attr("value");
            location.href = "/play/" + value + "/" + $("#" + value).attr("value");
        });

        //update name
        $('#name_update').click(function () {
            updateInfo($('#name_view'), $('#name_view').text(), 'name');
        });

        //歴計算
        calcHistory(str_dt, $('#begun_from'));
@stop

@section('script_other')
    //歴計算
    function calcHistory(dt, target) {
        var dt_old = new Date(dt);
        var dt_new = new Date();

        var diff_y = dt_new.getFullYear() - dt_old.getFullYear();
        var diff_m = (dt_new.getMonth() + 1) - (dt_old.getMonth() + 1);

    	if (diff_m < 0) {
    		diff_y--;
    		diff_m += 12;
    	}

    	target.attr('title', 'since ' + dt);
    	target.text(diff_y + "年" + diff_m + "ヶ月");
    }
@stop

@section('style')
    .table-btn {
        display: table;
        border-collapse: collapse;
    }
    .table-btn DIV {
        display: table-row;
    }
    .table-btn .cell {
        display: table-cell;
    }

    INPUT[type="number"] {
        text-align: right;
    }

    #logout {
        position: fixed;
        bottom: 0px;
        right: 0px;
    }

    #modal-trigger {
        cursor: pointer;
    }

    .table-responsive th, td {
        white-space: nowrap;
    }
@stop

@section('content')
<header></header>

    <div class="row">
        <!--大枠のレイアウト(ボタンとユーザ情報)-->
        <div class="col-xs-12 col-md-4">
            <div class="row">
                <div class="col-xs-7">
                    <button type="button" value="en" class="btn btn-primary btn-block" title="［終了］ボタンを押したら終了するモード">エンドレスモード</button>
                </div>
                <div class="col-xs-5">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-7">
                    <button type="button" value="li" class="btn btn-primary btn-block" title="予めショット数を決めて、入っても外しても指定ショット数で終了するモード">ショット数制限モード</button>
                </div>
                <div class="col-xs-5 input-group">
                    <div class="input-group-addon">ショット数 <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span></div>
                    <input id="li" type="number" class="form-control" value="{{ \Auth::user()->def_li }}">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-7">
                    <button type="button" value="cn" class="btn btn-primary btn-block" title="予め決めたショット合計成功数に到達したら終了するモード">成功数到達モード</button>
                </div>
                <div class="col-xs-5 input-group">
                    <div class="input-group-addon">成功数 <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span></div>
                    <input id="cn" type="number" class="form-control" value="{{ \Auth::user()->def_cn }}">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-7">
                    <button type="button" value="cs" class="btn btn-primary btn-block" title="予め決めた連続成功数に到達したら終了するモード">連続成功数到達モード</button>
                </div>
                <div class="col-xs-5 input-group">
                    <div class="input-group-addon">連続成功数 <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span></div>
                    <input id="cs" type="number" class="form-control" value="{{ \Auth::user()->def_cs }}">
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-8">
            <div class="row center-block">
                <div class="col-xs-6">
                    <h4>User info</h4>
                </div>
                <div class="col-xs-6 text-right">
                    <a class="btn btn-primary btn-sm btn-info" data-toggle="modal" data-target="#myModal">Tool Info</a>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>名前</th>
                            <th>登録日</th>
                            <th>ビリヤード歴</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <span id="name_view">{{ \Auth::user()->name }}</span>
                                <a href="#!" id="name_update"><i class="tiny material-icons">settings_applications</i></a>

                            </td>
                            <td>{{ date_format(date_create(\Auth::user()->created_at), "Y/m/d") }}</td>
                            <td>
                                <span id="begun_from" title=""></span>
                                <div class="uk-form-select" data-uk-form-select>
                                <form class="uk-form"><input type="button" id="dt_history"></form>
                                <a href="#modal-history"><i class="tiny material-icons">settings_applications</i></a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>





<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
        <h4>Tool info</h4>
      </div>
      <div class="modal-body table-responsive">
            @if (count($toolInfo) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>タイプ</th>
                        <th>キュー(バット)</th>
                        <th>シャフト</th>
                        <th>ジョイント</th>
                        <th>タップ</th>
                        <th>その他</th>
                        <th>所有</th>
                        <th>購入日</th>
                    </tr>
                </thead>
                <tbody>
                @for ($i = 0; $i < count($toolInfo); $i++)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $toolInfo[$i]['type'] }}</td>
                        <td>{{ $toolInfo[$i]['maker_butt'] }}:{{ $toolInfo[$i]['name_butt'] }}</td>
                        <td>{{ $toolInfo[$i]['maker_shaft'] }}:{{ $toolInfo[$i]['name_shaft'] }}</td>
                        <td>{{ $toolInfo[$i]['joint'] }}</td>
                        <td>{{ $toolInfo[$i]['maker_tip'] }}:{{ $toolInfo[$i]['name_tip'] }}</td>
                        <td>{{ $toolInfo[$i]['other'] }}</td>
                        <td>{{ ($toolInfo[$i]['loose']) ? '○' : '×' }}</td>
                        <td>{{ date_format(date_create($toolInfo[$i]['bought_at']), "Y/m/d") }}</td>
                    </tr>
                @endfor
                </tbody>
            </table>
            @endif
      </div>
      <div class="modal-footer">
        <a class="btn btn-default" data-dismiss="modal">AddNew</a>
      </div>
    </div>
  </div>
</div>




        <div class="col s12 m5 l8">
        </div>
        <div class="col s12 m5 l8 blue">
            <h4>Play info</h4>
            <h5>プレイ回数：{{ count($playInfo) }}回</h5>
@if (count($playInfo) > 0)
<!-- プレイ詳細 -->
@endif
        </div>
    </div>

<a href="/logout" class="btn-floating btn-middle waves-effect waves-light tooltipped" style="background-color:#3a5795" id="logout" data-position="left" data-delay="50" data-tooltip="Logout"><i class="material-icons">arrow_drop_down</i></a>

<footer></footer>
@stop