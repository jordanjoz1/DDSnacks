<?php 

class Comment extends Eloquent {

    protected $table = 'comments';

    public function user()
    {
        return $this->belongsTo('User');
    }


}