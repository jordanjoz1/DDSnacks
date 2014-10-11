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
        $snacks = Snack::with('comments', 'comments.user')
            ->leftJoin('votes', function($join)
            {
                $join->on('snacks.id', '=', 'votes.snack_id')
                    ->where('votes.user_id', '=', Auth::user()->id);
            })
            ->select('snacks.*', 'votes.value as vote_value')
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
        // validate user input
        $rules = array(
            'name'    => 'required|max:50',
            'description' => '',
            'group_id' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails())
        {
            $errors = $validator->errors();
            return Response::json(array(
                    'error' => true,
                    'snack' => $errors->toArray()),
                200
            );
        }

        // make the entire vote a transaction
        DB::beginTransaction();

        // check if snack already exists (since the unique is across two
        // columns I can't check for this in the validator
        $snack = Snack::where('name', Request::get('name'))
            ->where('group_id', Request::get('group_id'))
            ->first();
        if (!empty($snack)) {
            return Response::json(array(
                    'error' => true,
                    'message' => 'Snack with that name already exists in this group'),
                200
            );
        }

		$snack = new Snack;
        $snack->name = Request::get('name');
        $snack->description = Request::get('description');
        $snack->group_id = Request::get('group_id');
        $snack->created_by = Auth::user()->id;
        $snack->upvotes = 0;
        $snack->downvotes = 0;
        
        $snack->save();

        // make the entire vote a transaction
        DB::commit();
        
        return Response::json(array(
            'error' => false,
            'snack' => $snack->toArray()),
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
