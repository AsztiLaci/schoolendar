<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//--------------- Nincs bejelentkezve esetek: -----------------------------

	Route::get('login', array('uses' => 'UserController@showLogin'));

	Route::post('login', array('uses' => 'UserController@login'));


	App::missing(function($exception)
	{
        	Redirect::to(URL::to('/'));
	});


//--------------- Bejelentkezve esetek: -----------------------------------
Route::group(array('before' => 'auth'), function() {

	/*
	Route::get('login', function()
        {
                Redirect::to(URL::to('/'));
        });

	Route::post('login', function()
        {
           	Redirect::to(URL::to('/'));
        });
	*/
	Route::get('/', 'NewsController@fooldal');

	//----------Sajat profil------------------
	Route::get('myprofile', function()
	{
        	return View::make('myprofile');
	});

	Route::post('myprofile', 'UserController@myprofilechange');
	

	//----------Naptar------------------------
        Route::get('calendar', function()
        {
                return View::make('calendar');
        });

        Route::post('calendar', function()
        {
            //    return(array('uses' => 'UserController@myprofilechange'));
        });
	

	//----------User szerkesztese-------------
	
	Route::get('userlist','UserController@userlist');

	//Route::get('userlist/new','UserController@newuser');

        Route::get('useredit/{id}', 'UserController@useredit');	

        Route::post('useredit/{id}', 'UserController@usereditchange');

	Route::get('userdel/{id}', 'UserController@userdelete');

	Route::get('loginas/{id}', 'UserController@megszemelyesit');

	Route::get('loginback', 'UserController@megszemelyesitoff');


	//----------Hirek szerkesztese-------------

        Route::get('newslist','NewsController@newslist');

        Route::get('newsedit/{id}', 'NewsController@newsedit');

        Route::post('newsedit/{id}', 'NewsController@newseditchange');

        Route::get('newsdel/{id}', 'NewsController@newsdelete');
	
	//---------- Esemenyek -------------

	Route::get('eventlist','EventsController@eventlist');	

	Route::get('eventedit/{id}', 'EventsController@admineventedit');

	Route::post('eventedit/{id}', 'EventsController@admineventeditsave');

	Route::get('mycalendar', 'EventsController@mycalendar');
	
	Route::get('eventdel/{id}', 'NewsController@eventdelete');

	//----------Idopont keresek-------------
	
	Route::get('neweventrequest','EventsController@showneweventrequest');

	Route::post('neweventrequest','EventsController@neweventrequest');

    Route::get('eventrequests', 'EventsController@myeventrequest');
	
	Route::get('eventreqdeny/{id}', 'EventsController@requestdeny');
	
	Route::get('eventrequest/{id}', 'EventsController@eventrequestedit');
	
	Route::post('eventrequest/{id}', 'EventsController@eventrequestsave');






        //-----------
	Route::get('logout', array('uses' => 'UserController@logout'));
	
});

	//404
        App::missing(function($exception)
        {
	if (Auth::check()){
                return Response::view('404', array(), 404);
        } else {
		return Redirect::to(URL::to('/'));
	}
	});

