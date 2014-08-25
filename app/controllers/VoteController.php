<?php

class VoteController extends \BaseController {

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
        // validate user input
        $rules = array(
            'id'    => 'required|integer|exists:snacks',
            'value' => 'required|in:-1,1'
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

        // get input
        $id = Request::get('id');
        $value = Request::get('value');

        // attempt to get existing vote
        $vote = Vote::where('snack_id', $id)
            ->where('user_id', Auth::user()->id)
            ->take(1)
            ->get();

        // create a new vote if empty
        if (empty($vote))
        {
            $vote = new Vote;
            $vote->snack_id = $id;
            $vote->user_id = Auth::user()->id;
            $vote->value = $value;
        }
        else
        {
            $vote = $vote[0];
            // dont' allow user to make the same vote multiple times
            if ($vote->value == $value) {
                return Response::json(array(
                        'error' => true,
                        'snack' => "Already voted that way"),
                    200
                );
            }
            else {
                $vote->value = $value;
            }
        }
        $vote->save();

        //TODO the vote was successful, so subtract from remaining votes


        // update snack's votes
        $snack = Snack::where('id', $id)
            ->take(1)
            ->get();
        if (!empty($snack))
        {
            $snack = $snack[0];
            if ($value == 1) {
                $snack->upvotes = $snack->upvotes + 1;
            } else {
                $snack->downvotes = $snack->downvotes + 1;
            }
            $snack->save();
        }

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


}
