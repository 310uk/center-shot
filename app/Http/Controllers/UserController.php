<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

//facebook
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
use Facebook\Exceptions\FacebookSDKException;

//models
use App\User;
use App\Tool;
use App\Play;

//use DateTime;

class UserController extends Controller {

	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	//first access
	public function getIndex(LaravelFacebookSdk $fb)
	{
	    if (! \Auth::user()) {

	        return view('login', ['url' => $fb->getLoginUrl()]);

	    } else {

	        return view('home')->with([
	        	'toolInfo' => Tool::where('user_id', \Auth::user()->id)->get(),
	        	'playInfo' => Play::where('user_id', \Auth::user()->id)->get()
	        	]);

	    }
	}

	//logout
	public function getLogout()
	{
	    \Auth::logout();
	    return redirect('/');
	}

	//update info
	public function getUpdate()
	{
		dd(\Auth::user("id"));
	}

	//update info
	public function postUpdate()
	{
		//受け取りデータで更新
		$field = \Input::get("field");
		$value = \Input::get("value");

		\Auth::user()->$field = $value;
		\Auth::user()->save();

		//JSON返却
	    $response = array();
	    $response["newValue"] = $value;

	    return \Response::json($response);
	}

}
