<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;//软删除

class Post extends Model {

	//
    //use SoftDeletes;
    protected $guarded = array('id');

    //protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function node()
    {
        return $this->belongsTo('App\Node');
    }
}
