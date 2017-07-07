<?php
class EventUser extends Eloquent {

    protected $table = 'event_user';
	
	protected $fillable = ['user_id'];
	
	public $timestamps = false;
	
	public function userevents()
    {
        return $this->belongsTo('Events');
    }

}
