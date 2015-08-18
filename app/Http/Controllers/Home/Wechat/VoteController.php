<?php namespace App\Http\Controllers\Home\Wechat;
use App\Http\Controllers\Controller;
use App\Vote;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 8/18/15
 * Time: 9:08 AM
 */

class VoteController extends Controller{
    //活动首页
    public function show(Request $request,$wechatId,$voteId)
    {
        $vote = Vote::with(['players'=>function($query){
            $query->orderBy('join_number', 'asc');
        }])->find($voteId);

        if($request->ajax()){
            return response()->json(view('ucenter.public.vote.list',compact('vote'))->render());
        }

        return view('ucenter.public.vote.show',compact('vote'));
    }

} 