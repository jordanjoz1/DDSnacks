<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        //
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}
    
    public function postCreate()
    {
       //
    }


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
    
    public function login()
    {
        // redirect to home page if already logged in
        if (Auth::check()) {
            return Redirect::to('/');
        }

        // create random state id
        $state = md5(rand());
        Session::put('state', $state);
        $data = array (
            'CLIENT_ID' => Config::get('google.client_id'),
            'STATE' => $state,
            'APPLICATION_NAME' => 'DD Snacks'
        );
        return View::make('pages.login')->with($data);
    }
    
    public function postLogin()
    {
        // initialize Google's signin client
        $client = new Google_Client();
        $client->setApplicationName('DD Snacks');
        $client->setClientId(Config::get('google.client_id'));
        $client->setClientSecret(Config::get('google.client_secret'));
        $client->setRedirectUri('postmessage');

        // get the existing token, if there is one
        $token = Session::get('token');

        // Ensure that this is no request forgery going on, and that the user
        // sending us this connect request is the user that was supposed to.
        if (Input::get('state') != Session::get('state')) {
            return Response::json(array(
                    'error' => true,
                    'message' => 'Invalid state parameter. Please refresh page and try again.'),
                200
            );
        }

        // get code/token from form
        $request = Request::instance();
        $code = $request->getContent();

        // Exchange the OAuth 2.0 authorization code for user credentials.
        $client->authenticate($code);
        $token = json_decode($client->getAccessToken());

        // You can read the Google user ID in the ID token.
        // "sub" represents the ID token subscriber which in our case
        // is the user ID. This sample does not use the user ID.
        $attributes = $client->verifyIdToken($token->id_token, Config::get('google.client_id'))
            ->getAttributes();

        // verify that the user is using a DoubleDutch account
        $user_email = $attributes["payload"]["email"];
        if (!array_key_exists('hd', $attributes["payload"]) || $attributes["payload"]["hd"] != 'doubledutch.me')
        {
            return Response::json(array(
                    'error' => true,
                    'message' => 'You must login with a @doubledutch.me account'),
                200
            );
        }

        // create user object or get it if it already exists
        $user = User::where('email', '=',  $user_email)->first();
        if (empty($user)) {
            $user = new User;
            $user->email = $user_email;
            $user->password = Hash::make($this->randString(7));
            $user->save();
        }
        // log user in
        Auth::login($user);

        // Store the token in the session for later use.
        Session::put('token', json_encode($token));

        return Response::json(array(
                'error' => false,
                'message' => 'Successfully logged in'),
            200
        );
    }

    public function logout()
    {
        Auth::logout();
        $token = Session::get('token');
        if (!empty($token))
        {
            $token = json_decode(Session::get('token'))->access_token;
            //$client->revokeToken($token);
            // Remove the credentials from the user's session.
            Session::put('token', '');
            return "Successfully logged out";
        }
    }

    /**
     * Random string generator for creating passwords
     *
     * @param $length
     * @param string $charset
     * @return string
     */
    private function randString($length, $charset='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')
    {
        $str = '';
        $count = strlen($charset);
        while ($length--) {
            $str .= $charset[mt_rand(0, $count-1)];
        }
        return $str;
    }

}
