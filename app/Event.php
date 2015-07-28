<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 6/8/15
 * Time: 4:00 PM
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {

    protected $guarded = array('id');

    public function awards()
    {
        return $this->hasMany('App\Award');
    }
}
