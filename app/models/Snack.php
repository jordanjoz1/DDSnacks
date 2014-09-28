<?php 

class Snack extends Eloquent {

    protected $table = 'snacks';

    public function comments()
    {
        return $this->hasMany('Comment');
    }

    public function user()
    {
        return $this->belongsTo('User', 'created_by');
    }

}