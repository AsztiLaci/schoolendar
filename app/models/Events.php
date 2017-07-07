<?php

//azert a tobbes szam, mert nincs kedvem namespace-ezni...
class Events extends Eloquent {

    protected $table = 'event';

    public function scopeSchool($query)
    {
        return $query->whereType(0);
    }

    public function scopeTeachers($query)
    {
        return $query->whereType(1);
    }

    public function scopeGroup($query)
    {
        return $query->whereType(2);
    }

    public function scopePerson($query)
    {
        return $query->whereType(3);
		
    }



    public function eventgroup()
    {
        return $this->hasMany('EventGroup');
    }

    public function eventuser()
    {
		//Azert van meghatarozva a tavoli kulcs, mert a laravel minden aron tobbes szamban keresne ( events_id <- ilyen nincs ) 
        return $this->hasMany('EventUser', 'event_id')->timestamps = false;
    }
	
	public function eventuseris($id)
    {
		return $this->hasMany('EventUser')->person()->where('user_id', '=', $id);
    }


}
