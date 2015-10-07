<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
use Facebook\Exceptions\FacebookSDKException;

use App\User;

class FacebookController extends Controller {

	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	//access to fbcallback
	public function getIndex(LaravelFacebookSdk $fb)
	{

	    // Obtain an access token.
	    try {
	        $token = $fb->getAccessTokenFromRedirect();
	    } catch (FacebookSDKException $e) {
	        dd($e->getMessage());
	    }

	    // Access token will be null if the user denied the request
	    // or if someone just hit this URL outside of the OAuth flow.
	    if (! $token) {
	        // Get the redirect helper
	        $helper = $fb->getRedirectLoginHelper();

	        if (! $helper->getError()) {
	            abort(403, 'Unauthorized action.');
	        }

	        // User denied the request
	        dd(
	            $helper->getError(),
	            $helper->getErrorCode(),
	            $helper->getErrorReason(),
	            $helper->getErrorDescription()
	        );
	    }

	    if (! $token->isLongLived()) {
	        // OAuth 2.0 client handler
	        $oauth_client = $fb->getOAuth2Client();

	        // Extend the access token.
	        try {
	            $token = $oauth_client->getLongLivedAccessToken($token);
	        } catch (FacebookSDKException $e) {
	            dd($e->getMessage());
	        }
	    }

	    $fb->setDefaultAccessToken($token);

	    // Save for later
	    \Session::put('fb_user_access_token', (string) $token);

	    // Get basic info on the user from Facebook.
	    try {
	        $response = $fb->get('/me?fields=id,name,email');
	    } catch (FacebookSDKException $e) {
	        dd($e->getMessage());
	    }

	    // Convert the response to a `Facebook/GraphNodes/GraphUser` collection
	    $facebook_user = $response->getGraphUser();

		//名前は更新しない
		$model = User::where('facebook_user_id', '=', $facebook_user['id'])->first();
//dd($model);
		if (count($model) == 1) {
			$facebook_user['name'] = $model['name'];
		}
	    // Create the user if it does not exist or update the existing entry.
	    // This will only work if you've added the SyncableGraphNodeTrait to your User model.
	    $user = User::createOrUpdateGraphNode($facebook_user);

	    // Log the user into Laravel
	    \Auth::login($user);

	    return redirect('/')->with('message', 'Successfully logged in with Facebook');

	}

}
