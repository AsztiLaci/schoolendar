<?php
class News extends Eloquent {

    protected $table = 'news';

    public function user()
    {
        return $this->hasOne('displayname');
    }

}
