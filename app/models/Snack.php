<?php 

class Snack extends Eloquent {

    protected $table = 'snacks';

    public function comments()
    {
        return $this->hasMany('Comment');
    }

    public function votes()
    {
        return $this->hasMany('Vote');
    }

    public function user()
    {
        return $this->belongsTo('User', 'created_by');
    }

    public function group()
    {
        return $this->belongsTo('Group', 'group_id');
    }

}