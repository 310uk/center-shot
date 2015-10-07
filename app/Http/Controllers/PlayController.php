<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

//models
use App\Play;
use App\Shot;
use App\Pause;

class PlayController extends Controller {

	public function __construct(){
		//ログイン状況確認
	    $this->middleware('guest');
	}

    public function getIndex()
    {
    	//モードの引数が必要
        return redirect('/')->with('message', "illegal URL.");
    }

	// 1.	エンドレスモード([終了]ボタンを押したら終了)
    public function getEn()
    {
		echo 'Endress.';
    }

	// 2.	ショット数制限モード(予めショット数を決めて、入っても外しても指定ショット数で終了)
	public function getLi($cnt)
	{
	    return view('play')->with([
	    	'type' => Tool::where('user_id', \Auth::user()->id)->get(),
	    	'playInfo' => Play::where('user_id', \Auth::user()->id)->get()
	    	]);
	}

	// 3.	成功数到達モード(予め決めたショット合計成功数に到達したら終了)
	public function getCn($cnt)
	{
		echo $cnt;
	}

	// 4.	連続成功数到達モード(予め決めた連続成功数に到達したら終了)
	public function getCs($cnt)
	{
		echo $cnt;
	}

}
