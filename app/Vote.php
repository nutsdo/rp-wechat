<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model {

	protected $guarded = array();

    public function players()
    {
        return $this->hasMany('App\VoteUsers');
    }

}
