<?php

//Szinten akarcsak a model-nel:
class EventsController extends \BaseController {
	var $usertypes = array("Admin", "Igazgató", "Igazgató helyettes", "Tanár", "Diák");
	var $eventtypes =array("Iskolai", "Tanári kari", "Csoport", "Személyes");

	var $eventreqstatus= array("Elutasítva","Új","Jóváhagyásra vár","Elfogadva");

	public function mycalendar(){
		$kezdet = Input::get('start');
		$vege_temp = Input::get('end');
		$vege = date('Y-m-d', strtotime($vege_temp. '+ 1 days')); // a 00:00 miatt


		// 10 percre cache-elem a lekerdezeseket
		if(!is_null($kezdet) &&  !is_null($vege)){
			$iskolai=Events::school()->where('start', '>=', $kezdet)->where('end', '<=', $vege)->remember(10)->get();
			if (Auth::user()->type<4){
				$tanariesemenyek=Events::teachers()->where('start', '>=', $kezdet)->where('end', '<=', $vege)->remember(10)->get();
			} else {
				$tanariesemenyek=new \Illuminate\Database\Eloquent\Collection;
				//hogy ne sirjon undefined miatt
			}
			$egyeni = Events::whereHas('eventuser', function($q)
			{
				$q->where('user_id', Auth::user()->id);
			})->where('start', '>=', $kezdet)->where('start', '<=', $vege)->remember(10)->get();

		} else {
			$iskolai=Events::school()->remember(10)->get();
			if (Auth::user()->type<4){
				$tanariesemenyek=Events::teachers()->remember(10)->get();
			} else {
				$tanariesemenyek=new \Illuminate\Database\Eloquent\Collection;
				//hogy ne sirjon undefined miatt:
			}
			//$egyeni=Events::person()->where(Events->eventuser(), '=', Auth::user()->id)->get();
			//$egyeni=Events()->eventuseris(Auth::user()->id);
			//$egyeni=EventUser::where('user_id', Auth::user()->id)->userevents;
			$egyeni = Events::whereHas('eventuser', function($q)
			{
				$q->where('user_id', Auth::user()->id);
			})->remember(10)->get();
		}


		$naptar=array_merge($tanariesemenyek->toArray(), $iskolai->toArray(), $egyeni->toArray());

		return $naptar;

	}

	public function showneweventrequest(){
		/*
		   $tanarikarID = DB::select('select id from users where type = 2 OR type = 3');
		   $tanarikarDN = DB::select('select displayname from users where type = 2 OR type = 3');
		   return View::make('neweventrequest')->withTanarikarid($tanarikarID)->withTanarikardn($tanarikarDN);
		 */
		//$tanarikar = DB::table('users')->select('id', 'displayname')->Where('type', 2)->orWhere('type',3)->orWhere('type',4)->get();
		//$tanarikar = DB::table('users')->select('id', 'displayname')->Where('type', 2)->orWhere('type',3)->orWhere('type',4)->keyBy('id')->get();

		//$tanarikar = User::where('type', '>', 1);//->pluck('id', 'displayname');

		$tanarikar = DB::select('select id,displayname,type from users where type > 0 AND type < 4');

		return View::make('neweventrequest')->withTanarikar($tanarikar)->withUsertypes($this->usertypes);
	}

	public function neweventrequest(){
		$eventrequest = new EventRequest();
		$eventrequest->title = Request::input('title');
		$eventrequest->description = Request::input('description');
		$eventrequest->date = Request::input('date');
		$eventrequest->status = 1;
		$eventrequest->from_id = Auth::user()->id;
		$eventrequest->to_id = Request::input('to');
		$eventrequest->save();

		//A teszt kornyezetre es a teszt userekre (kamu mail) valo tekintette kikommentezve:
		/*
		Mail::send('emails.newrequest', $eventrequest->toArray(), function($message)
		{
			$message->from('no-reply@'.Request::server ("HTTP_HOST"), 'Értesítés');
			$message->to(User::find(Request::input('to'))->email);
			//$message->attach($nincscsatolmany);
		});
        */
		return Redirect::to('eventrequests');

	}

	public function eventrequestedit($id){
		if (Auth::user()->type<4){
				$eventreq = EventRequest::find($id);
				if ($eventreq->to_id==Auth::user()->id){
					return View::make('requestedit')->withEventreq($eventreq)->withStatus($this->eventreqstatus);
				} else {
					return Redirect::to('/');
				}
		} else {
			return Redirect::to('/');
		}
	}

	public function eventrequestsave($id){
		if (Auth::user()->type<4){
				$eventreq = EventRequest::find($id);
				if ($eventreq->to_id==Auth::user()->id){
					$eventreq->status=3;
					$eventreq->date=Request::input('start');
					$eventreq->save();
					$event = new Events();
					$event->start=Request::input('start');
					$event->end=Request::input('end');
					$event->created_by=Auth::user()->id;
					$event->title=$eventreq->title;
					$event->description=$eventreq->description;
					$event->type=3;

					$eventusers= array(
						new EventUser(array('user_id' => $eventreq->from_id, 'timestamps' => 'false')),
						new EventUser(array('user_id' => $eventreq->to_id, 'timestamps' => 'false')),
						);

					$eventreq->save();
					$event->save();

					$event->eventuser()->saveMany($eventusers);

					return Redirect::to('/eventrequests');
				} else {
					return Redirect::to('/');
				}
		} else {
			return Redirect::to('/');
		}
	}

	public function myeventrequest(){
		$myevents = EventRequest::where('to_id', Auth::user()->id)->orWhere('from_id', Auth::user()->id)->get();
		return View::make('myeventrequestlist')->withMyevents($myevents)->withStatus($this->eventreqstatus);

	}

	public function requestdeny($id){
		if (!is_null($id)){
		$eventreq = EventRequest::find($id);
			if ($eventreq->to_id==Auth::user()->id){
				if($eventreq['status']!=0 && $eventreq['status']!=3) {
					$eventreq->status=0;
					$eventreq->save();
				}

			} else {
				return Redirect::to('/');
			}
		} else {
			return Redirect::to('/');
		}

	}
/*
	public function admineventlist(){
		$events = Events::where('type',0)->orWhere('type',1)->get();
	}
*/
	public function usereventlist(){
		//var $userallevent;

	}

	public function admineventedit($id){
                if (Auth::user()->type<2){
                        if (!is_null($id)){
                                $event = Events::find($id);
                                return View::make('eventedit')->withEvent($event)->withEventtypes($this->eventtypes);
                        } else {
                                return Redirect::to('eventlist');
                        }

                } else {
                        return Redirect::to('/');
                }
        }


	public function admineventeditsave($id){
		if (Auth::user()->type<2){
                        if (!is_null($id)){
                                if($id!="new"){
					$event = Events::find($id);
					$event->title = Request::input('title');
					$event->created_by = Auth::user()->id;
					$event->description = Request::input('description');
					$event->type = Request::input('type');
					$event->start = Request::input('start');
					$event->end = Request::input('end');
					$event->save();
					return Redirect::to('eventlist');
				} else {
					$event = new Events();
                			$event->title = Request::input('title');
					$event->created_by = Auth::user()->id;
                			$event->description = Request::input('description');
                			$event->type = Request::input('type');
                			$event->start = Request::input('start');
                			$event->end = Request::input('end');
                			$event->save();
					return Redirect::to('eventlist');
				}
			} else {
				return Redirect::to('eventlist');
			}

		} else {
			return Redirect::to('/');
		}
	}
	public function eventlist(){
		if (Auth::user()->type<2){
			$events = Events::where('type','<',3)->orderBy('start', 'desc')->get();
    	return View::make('eventlist')->withEvents($events)->withEventtypes($this->eventtypes);
		} else {
				return Redirect::to('/');
		}
	}

	public function eventdelete($id) {
		if (Auth::user()->type<2){
			if (!is_null($id)){
				$event = Events::find($id);
				$event->delete();
			} else {
				return Redirect::to('/');
			}
		} else {
			return Redirect::to('/');
		}
	}
}
