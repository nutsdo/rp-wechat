<?php namespace App\Http\Controllers\Home\Wechat;
use App\Http\Controllers\Controller;
use App\Vote;
use App\VoteUsers;
use App\Wechat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Overtrue\Wechat\User;

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
        $this->updateJoinCount($voteId);
        $wechat = Wechat::find($wechatId);

        if($request->route('userid')){//订阅号
            $userid = $request->route('userid');

            //保存用户openid到session
            Session::put('logged_userid', $userid);
            $user = Session::get('logged_userid');

        }else{//未关注、认证服务号
            $user = '';//表示用户未关注
        }
        $vote = Vote::with(['players'=>function($query){
            $query->orderBy('join_number', 'asc');
        }])->find($voteId);

        if($request->ajax()){
            return response()->json(view('ucenter.public.vote.list',compact('vote','wechatId','voteId','user'))->render());
        }

        return view('ucenter.public.vote.show',compact('vote','wechatId','voteId','user'));
    }

    public function topList($wechatId,$voteId)
    {
        $vote = Vote::find($voteId);
        $vote_users = VoteUsers::where('vote_id','=',$voteId)->orderBy('voted_count','DESC')->paginate(20);
        $voter = Session::get('logged_userid');
        return view('ucenter.public.vote.top-list',compact('wechatId','voteId','vote','vote_users','voter'));
    }

    public function userInfo($wechatId,$voteId,$userId)
    {
        $vote = Vote::find($voteId);
        $user = VoteUsers::find($userId);
        $voter = Session::get('logged_userid');
        $userid = session('logged_user.userid');
        $ranking = $this->ranking($voteId, $user);
        return view('ucenter.public.vote.user',compact('user','wechatId','vote','ranking','userid','voter'));
    }

    //计算投票排名
    public function ranking($voteId,$user)
    {
        //计算排名
        //先计算是否有相同票数的参与者,获取有相同票数的参与者的数量
        $same_user = VoteUsers::whereRaw("vote_id=$voteId and voted_count=$user->voted_count")->count();
        if($same_user==1){
            $num = 1;
        }else{
            $count = VoteUsers::whereRaw("vote_id=$voteId and voted_count=$user->voted_count and UNIX_TIMESTAMP(created_at)<UNIX_TIMESTAMP('$user->created_at')")->count();
            $num = $count + 1;
        }
        $ranking = VoteUsers::whereRaw("vote_id=$voteId and voted_count>$user->voted_count")->count() + $num;
        return $ranking;
    }
    //活动时间
    public function voteDate($voteId)
    {
        $vote = Vote::find($voteId);
        if(strtotime($vote->start_at)>time()){
            $result = 'no_start';
        }elseif(strtotime($vote->end_at)<time()){
            $result = 'end';
        }
        return $result;
    }

    //更新访问次数
    public function updateJoinCount($voteId){
        //更新访问次数
        $vote = Vote::find($voteId);
        $vote->view_count += 1;
        $vote->save();
    }

} 