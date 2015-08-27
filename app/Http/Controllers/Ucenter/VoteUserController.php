<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 8/13/15
 * Time: 9:16 AM
 */

namespace App\Http\Controllers\Ucenter;

use App\Http\Requests\StoreVoteUserRequest;
use App\Repositories\WechatRepositories\VoteUserRepository;
use App\Vote;
use App\VoteRecord;
use App\VoteUsers;
use Illuminate\Http\Request;

class VoteUserController extends BaseController{
    public $vote;

    public function __construct(VoteUserRepository $vote)
    {
        $this->middleware('wechatAuth');
        //parent::__construct();
        $this->vote = $vote;
    }

    //报名页面
    public function create($wechatId,$voteId)
    {
        $status = $this->voteDate($voteId);
        if($status=='no_start'){
            return view('ucenter.public.vote.fail',compact('wechatId','voteId','status'));
        }elseif($status=='end'){
            return view('ucenter.public.vote.fail',compact('wechatId','voteId','status'));
        }

        return view('ucenter.public.vote.user_register',compact('voteId'));
    }

    //
    public function store(StoreVoteUserRequest $request,$wechatId,$voteId)
    {
        $user = $this->vote->create($request,$wechatId,$voteId);
        if($user){
            return redirect()->route('ucenter.wechat.vote.user.success',[$wechatId,$voteId]);
        }else{
            return redirect()->route('ucenter.wechat.vote.user.fail',[$wechatId,$voteId]);
        }
    }

    public function success($wechatId,$voteId)
    {
        return view('ucenter.public.vote.success',compact('wechatId','voteId'));
    }

    public function fail($wechatId,$voteId)
    {
        return view('ucenter.public.vote.fail',compact('wechatId','voteId'));
    }

    public function show($wechatId,$voteId,$userId)
    {
        $user = VoteUsers::find($userId);
        return view('ucenter.public.vote.user',compact('user'));
    }

    public function voting(Request $request,$wechatId,$voteId,$userId){
        $status = $this->voteDate($voteId);
        if($request->ajax()){
            if($status=='no_start'){
                $result = ['msg'=>'活动未开始!','status'=>'error'];
            }elseif($status=='end'){
                $result = ['msg'=>'活动已结束!','status'=>'error'];
            }else{
                $data = $request->all();
                if($data['openid']==''){
                    $result = ['msg'=>'请先关注我们的公众号!','status'=>'error'];
                }else{
                    $result = $this->createVoting($wechatId,$voteId,$userId,$data);
                }
            }

            return response()->json($result);
        }
    }

    public function createVoting($wechatId,$voteId,$userId,$data)
    {
        //查询限制的投票次数
        $vote = Vote::find($voteId);
        $times = $vote->vote_times;
        //查询当前用户当天已投票次数
        $openid = $data['openid'];
        $voted_times = VoteRecord::whereRaw("vote_id=$voteId and open_id='$openid' and to_days(created_at)=to_days(now())")->count();
        //如果超出限制，则返回投票失败
        if($times>$voted_times){
            //投票操作
            $vote_res = VoteRecord::create([
                'wechat_id' => $wechatId,
                'vote_id' => $voteId,
                'open_id' => $data['openid'],
                'player_id' => $userId
            ]);
            //更新voted_count
            if($vote_res->id){
                $user = VoteUsers::find($userId);
                $user->voted_count += 1;
                $user->save();
            }
            //更新活动总票数
            //code ..
            $vote = Vote::find($voteId);
            $vote->vote_count += 1;
            $vote->save();

            $result = ['msg'=>'投票成功!','status'=>'success','result'=>$user];
        }else{
            $result = ['msg'=>'您的投票次数已达到最大限制!','status'=>'error'];
        }

        return $result;
    }

    //活动时间
    public function voteDate($voteId)
    {
        $vote = Vote::find($voteId);
        if(strtotime($vote->start_at)>time()){
            $result = 'no_start';
        }elseif(strtotime($vote->end_at)<time()){
            $result = 'end';
        }else{
            $result = 'doing';
        }
        return $result;
    }
}