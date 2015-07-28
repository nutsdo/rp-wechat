<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 6/9/15
 * Time: 3:01 PM
 */

namespace App\Repositories;

use App\Event;

class EventRepository {

    public function create(array $data)
    {

        $event_time = $this->dateToTime($data['event_time']);
        $start_at = $event_time['start_time'];
        $end_at = $event_time['end_time'];

        return Event::create([
            'title' => $data['title'],
            'planner' => $data['planner'],
            'description' => $data['description'],
            'start_at' => $start_at,
            'end_at' => $end_at,
            //'type' => $data['type'],
        ]);
    }

    public function update(array $data,$id)
    {
        $event_time = $this->dateToTime($data['event_time']);
        $start_at = $event_time['start_time'];
        $end_at = $event_time['end_time'];

        $event = Event::find($id);
        $event->title=$data['title'];
        $event->planner = $data['planner'];
        $event->start_at = $start_at;
        $event->end_at = $end_at;
        //$event->type = $data['type'];
        $event->save();
        return $event;
    }

    public function dateToTime($date)
    {
        $event_time = $date;
        $event_time = explode('-',$event_time);
        $start_time = trim($event_time[0]);
        $end_time = trim($event_time[1]);
        //日期格式转换成时间戳
        $start_time = strtotime($start_time);
        $end_time = strtotime($end_time);
        //时间戳转换成日期格式
        //$start_time = date('m/d/Y h:m A',$start_time);
        //$d['start_time'] = date('m/d/Y h:m A',$start_time);
        //$d['end_time'] = date('m/d/Y h:m A',$end_time);
        $d['start_time'] = $start_time;
        $d['end_time'] = $end_time;
        return $d;
    }
}