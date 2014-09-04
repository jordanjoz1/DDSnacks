<?php

class SnackController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // get snacks
        $snacks = DB::table('snacks')
            ->leftJoin('votes', function($join)
            {
                $join->on('snacks.id', '=', 'votes.snack_id')
                    ->where('votes.user_id', '=', Auth::user()->id);
            })
            ->select('snacks.*', 'votes.value as vote_value', DB::raw('snacks.upvotes - snacks.downvotes as sum_votes'))
            ->orderBy('sum_votes', 'desc')
            ->get();

        
        return Response::json(array(
            'error' => false,
            'snacks' => $snacks),
            200
        );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$snack = new Snack;
        $snack->name = Request::get('name');
        $snack->description = Request::get('description');
        $snack->created_by = Auth::user()->id;
        
        // validation and filtering?
        
        $snack->save();
        
        return Response::json(array(
            'error' => false,
            'snacks' => $snack->toArray()),
            200
        );
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		// make sure current user owns the requested resource
        $snack = Snack::where('created_by', Auth::user()->id)
                    ->where('id', $id)
                    ->take(1)
                    ->get();

        return Response::json(array(
            'error' => false,
            'snack' => $snack->toArray()),
            200
        );
	}
        
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$snack = Snack::where('created_by', Auth::user()->id)->find($id);
        
        $snack->delete();
        
        return Response::json(array(
            'error' => false,
            'message' => 'snack deleted'),
            200
        );
    }


}
