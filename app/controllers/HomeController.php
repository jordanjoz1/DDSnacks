<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showMainPage() 
    {
        // get snacks
        $snacks = DB::table('snacks')
            ->leftJoin('votes', function($join)
            {
                $join->on('snacks.id', '=', 'votes.snack_id')
                    ->where('votes.user_id', '=', Auth::user()->id);
            })
            ->select('snacks.*', 'votes.value as vote_value')
            ->get();

        return View::make('index')->with('snacks', $snacks);
    }
    
    public function doLogout()
	{
		Auth::logout();
		return Redirect::to('login');
	}

}
