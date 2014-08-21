<?php

class SnackController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$snacks = Snack::where('created_by', Auth::user()->id)->get();
        
        return Response::json(array(
            'error' => false,
            'snacks' => $snacks->toArray()),
            200
        );
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
		$snack = new Snack;
        $snack->name = Request::get('name');
        $snack->description = Request::get('description');
        $snack->created_by = Auth::user()->id;
        
        // validation and filtering?
        
        $snack->save();
        
        return Response::json(array(
            'error' => false,
            'snacks' => $snacks->toArray()),
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
            'urls' => $url->toArray()),
            200
        );
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
		$snack = Snack::where('created_by', Auth::user()->id)->find($id);
        
        if (Request::get('name'))
        {
            $snack->name = Request::get('name');
        }
        
        if (Request::get('description'))
        {
            $snack->description = Request::get('description');
        }
        
        $snack->save();
        
        return Response::json(array(
            'error' => false,
            'message' => 'snack updated'),
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
