<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 8/17/15
 * Time: 2:34 PM
 */
 ?>
@foreach($vote->players as $player)
<div class="cell thumbnail mar mar1">
    <a href="#">
    {!! Html::image($player->image_url) !!}
    </a>
    <div class="caption mes">
         <span class="pull-left">{{$player->join_number}}号参赛</span><span class="pull-right">No.{{$player->join_number}}</span><br>
         <span class="pull-left">{{$player->nickname}}</span><span class="pull-right">{{$player->voted_count}}票</span>
         <!-- Button trigger modal -->
         <button type="button" class="btn btn-primary btnbj" data-toggle="modal" data-event="vote" data-player_id="{{$player->id}}">
             投票
         </button>
     </div>
</div>
@endforeach