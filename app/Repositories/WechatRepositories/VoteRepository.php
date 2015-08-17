<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 8/11/15
 * Time: 3:39 PM
 */

namespace App\Repositories\WechatRepositories;


use App\Vote;

class VoteRepository {

    public function create($wechatId,array $data)
    {
        $time = explode(' - ',$data['vote_time']);
        $start_time = trim($time[0]);
        $end_time = trim($time[1]);
        return Vote::create([
            "wechat_id" => $wechatId,
            "name" => $data['name'],
            "pic_url" => $data['pic_url'],
            "description" => $data['description'],
            "rule_body" => $data['rule_body'],
            "vote_times" => $data['vote_times'],
            "start_at" => $start_time,
            "end_at" => $end_time
        ]);
    }

    public function update($wechatId,$id,array $data)
    {
        $time = explode(' - ',$data['vote_time']);

        $start_time = trim($time[0]);
        $end_time = trim($time[1]);

        $vote = Vote::find($id);
        $vote->name = $data['name'];
        $vote->pic_url = $data['pic_url'];
        $vote->description = $data['description'];
        $vote->rule_body = $data['rule_body'];
        $vote->vote_times = $data['vote_times'];
        $vote->start_at = $start_time;
        $vote->end_at = $end_time;
        $vote->save();

        return $vote;
    }
} 