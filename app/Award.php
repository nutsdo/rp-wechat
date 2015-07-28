<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 6/9/15
 * Time: 5:11 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Award extends Model{
    protected $guarded = array('id');

    public function event()
    {
        return $this->belongsTo('App\Event');
    }
} 