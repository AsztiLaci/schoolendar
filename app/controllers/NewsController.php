<?php

class NewsController extends \BaseController {

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

	public function fooldal() {
                //$news = News::paginate(5);
		$news = News::orderby("created_at", "desc")->paginate(5);
                //return View::make('userlist')->with('news', $news);
                return View::make('dashboard')->withNews($news);
        }

	public function newslist() {
                $news = News::all();
                //return View::make('userlist')->with('news', $news);
                return View::make('newslist')->withNews($news);
        }

        public function newsdelete($id) {
                if (Auth::user()->type<2){
                        if (!is_null($id)){
                                $news = News::find($id);
                                $news->delete();
                        } else {
                                return Redirect::to('/');
                        }
                } else {
                        return Redirect::to('/');
                }
        }

	public function newsedit($id) {
                if (Auth::user()->type<2){
                        if (!is_null($id)){
                                $news = News::find($id);
                                return View::make('newsedit')->withNews($news);
                        } else {
                               //return View::make('newnews');
                        }
                } else {
                        return Redirect::to('/');
                }
        }

	public function newseditchange($id) {
                if (Auth::user()->type<2){
                        if (!is_null($id)){
                                if($id!="new"){
                                        $news = News::find($id);
                                        $news->title = Request::input('title');
                                        $news->description = Request::input('description');
					$news->published_by = Auth::user()->id;
					//$news->published_at = date('Y-m-d H:i:s');
					
                                        
                                        $news->save();
                                        return Redirect::to('newslist');
                                } else {
                                        $news = new News();
                                        $news->title = Request::input('title');
					$news->published_by = Auth::user()->id;
                                        $news->description = Request::input('description');
                                        //$news->published_at = date('Y-m-d H:i:s');
                                        

                                        $news->save();
                                        return Redirect::to('newslist');
                                }
                        } else {
                                return View::make('newnews');
                        }
                } else {
                        return Redirect::to('/');
                }
        }


}
