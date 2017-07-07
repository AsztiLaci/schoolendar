<?php

class UserController extends \BaseController {
	//var $usertypes = array("Diák", "Admin", "Igazgató", "Igazgató helyettes", "Tanár");
	var $usertypes = array("Admin", "Igazgató", "Igazgató helyettes", "Tanár", "Diák");
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// return View::make('userlist');
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

	public function showLogin()
	{
		// show the form
		return View::make('login');
	}

	public function login()
	{
		$data = Input::all();
		// validacios szabalyok
		$rules = array(
				'email' => 'required|email',
				'password' => 'required|min:6',
			      );

		$validator = Validator::make($data, $rules);
		if ($validator->fails()){
			// ha megbukik a validacio akkor visszanavigalunk
			return Redirect::to('/login')->withInput(Input::except('password'))->withErrors($validator);
		} else {
			$userdata = array(
					'email' => Input::get('email'),
					'password' => Input::get('password')
					);
			// beleptetes
			if (Auth::validate($userdata)) {
				if (Auth::attempt($userdata)) {
					return Redirect::intended('/');
				}
			} else {
				// ha bibi van visszakuldjuk egy uzivel
				Session::flash('error', 'Hibás bejelentkezés'); 
				return Redirect::to('login');
			}
		}
	}

	public function logout() {
		Auth::logout();
		return Redirect::to('login');
	}

	public function myprofilechange() {
		$user = Auth::user();

		//$user->username = Request::input('username');
		//$user->email = Request::input('email');

		if ( ! Request::input('password') == '')
		{
			$user->password = Hash::make(Request::input('password'));
		}

		$user->save();

		//   		Session::flash('info', 'Profilját frissítettük!');
		return Redirect::to('/');	 

	}
	public function userlist() {
        if (Auth::user()->type<2){
		  $users = User::all();
		  //return View::make('userlist')->with('users', $users);
		  return View::make('userlist')->withUsers($users)->withUsertypes($this->usertypes);
        } else {
            return Redirect::to('/');
        }
	}

	public function userdelete($id) {
		if (Auth::user()->type<2){
			if (!is_null($id)){
				$user = User::find($id);
				$user->delete();
				//return View::make('useredit')->with('user', $user);
				//return View::make('useredit', array('user' => $user, 'usertypes' => $usertypes));
			} else {
				return Redirect::to('/');
			}
		} else {
			return Redirect::to('/');
		}
	}

	public function megszemelyesit($id) {
                if (Auth::user()->type==0 && is_null(Session::get('aid'))){
                        if (!is_null($id)){
				$eredeti_uid=Auth::user()->id;
                                $user = User::find($id);
                                Auth::login($user);
				Session::put('megszemelyesit', true);
				Session::put('aid', $eredeti_uid);
				//Auth::user()->setAttribute('megszemelyesit',1);
				//Auth::user()->setAttribute('aid',$eredeti_uid);
                                return Redirect::to('/')->with('notify','Megszemélyesítés sikeres');
                        } else {
                                return Redirect::to('/');
                        }
                } else {
                        return Redirect::to('/');
                }
        }
	public function megszemelyesitoff() {
                if ((Session::get('megszemelyesit')) && (!is_null(Session::get('aid')))){
			$adminid=Session::get('aid');
                        $user = User::find($adminid);
			//Debug celbol:
			//unset(Auth::user()->aid);
			//unset(Auth::user()->megszemelyesit);
			Session::forget('aid');
			Session::forget('megszemelyesit');
			//beleptet:
                        Auth::login($user);
        		return Redirect::to('userlist');
                        
                } else {
                        return Redirect::to('/');
                }
        }

	public function useredit($id) {
		if (Auth::user()->type<2){
			if (!is_null($id)){
				$user = User::find($id);
				return View::make('useredit')->withUser($user)->withUsertypes($this->usertypes);
				//return View::make('useredit')->with('user', $user);
				//return View::make('useredit', array('user' => $user, 'usertypes' => $usertypes));
			} else {
				return View::make('newuser');
			}
		} else {
			return Redirect::to('/');
		}
	}

	public function usereditchange($id) {
                if (Auth::user()->type<2){
                        if (!is_null($id)){
				if($id!="new"){
                                	$user = User::find($id);
                                	$user->displayname = Request::input('displayname');
                			$user->type = Request::input('type');
                        		if ( ! Request::input('password') == '')
                			{
                		        	$user->password = Hash::make(Request::input('password'));
		                	}
					$user->save();
					return Redirect::to('userlist');
				} else {
					$user = new User();
					$user->email = Request::input('email');
					$user->displayname = Request::input('displayname');
					$user->type = Request::input('type');
					$user->password = Hash::make(Request::input('password'));
					$user->save();
					return Redirect::to('userlist');	
				}
			} else {
                                return View::make('newuser');
                        }
                } else {
                        return Redirect::to('/');
                }
        }

}

