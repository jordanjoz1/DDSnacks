<?php 

class Vote extends Eloquent {

    protected $table = 'votes';

    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

    public function snack()
    {
        return $this->belongsTo('Snack', 'snack_id');
    }

}