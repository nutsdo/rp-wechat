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
use Illuminate\Http\Request;

class VoteUserController extends BaseController{
    public $vote;

    public function __construct(VoteUserRepository $vote)
    {
        $this->middleware('wechatAuth');
        parent::__construct();
        $this->vote = $vote;
    }

    //参赛用户首页
    public function index()
    {

    }
    //报名页面
    public function create($wechatId,$voteId)
    {
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
        if($request->ajax()){
            return response()->json(['msg'=>'voted success!'.$userId,'status'=>'1']);
        }
    }
}