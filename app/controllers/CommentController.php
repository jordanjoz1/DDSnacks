<?php

class CommentController extends \BaseController {

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
            'id'    => 'required|exists:snacks',
            'comment' => 'required|max:500',
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

        $comment = new Comment;
        $comment->snack_id = Request::get('id');
        $comment->comment = Request::get('comment');
        $comment->user_id = Auth::user()->id;

        $comment->save();

        // get comment with user data
        $comment = Comment::with('user')->find($comment->id);

        return Response::json(array(
                'error' => false,
                'comment' => $comment->toArray()),
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
