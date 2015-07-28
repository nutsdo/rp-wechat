<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 6/9/15
 * Time: 9:31 PM
 */

namespace App\Repositories;

use App\Award;

class AwardRepository {

    public function create(array $data)
    {
        return Award::create([
            'name'=> $data['name'],
            'totals'=> $data['totals'],
            'surplus'=> $data['totals'],
            'event_id'=>$data['event_id']
        ]);
    }

    public function update(array $data, $id)
    {
        $award = Award::find($id);
        $award->name = $data['name'];
        $award->totals = $data['totals'];
        $award->surplus = $data['totals'];
        $award->event_id = $data['event_id'];
        $award->save();
        return $award;
    }
} 