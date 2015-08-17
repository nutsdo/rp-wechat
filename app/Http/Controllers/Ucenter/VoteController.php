<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 8/11/15
 * Time: 9:34 AM
 */

namespace App\Http\Controllers\Ucenter;


use App\Repositories\WechatRepositories\VoteRepository;
use App\Vote;
use App\VoteUsers;
use Illuminate\Http\Request;

class VoteController extends BaseController{

    private $vote;
    public function __construct(VoteRepository $vote)
    {
        parent::__construct();
        $this->vote = $vote;
    }

    public function index($wechatId)
    {
        $votes = Vote::where('wechat_id','=',$wechatId)->get();
        return view('ucenter.public.vote.index',compact('votes'));
    }

    public function create($wechatId)
    {
        return view('ucenter.public.vote.create');
    }

    public function store(Request $request,$wechatId)
    {
        $this->vote->create($wechatId,$request->all());
        flash()->success('修改成功');
        return redirect()->back();
    }

    public function edit($wechatId,$id)
    {
        $vote = Vote::find($id);
        return view('ucenter.public.vote.edit',compact('vote'));
    }

    public function update(Request $request,$wechatId,$id)
    {
        $this->vote->update($wechatId,$id,$request->all());

        flash()->success('修改成功');
        return redirect()->back();
    }
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

    public function topList($wechatId,$voteId)
    {
        $vote = Vote::find($voteId);
        $vote_users = VoteUsers::where('vote_id','=',$voteId)->orderBy('voted_count','DESC')->paginate(20);
        return view('ucenter.public.vote.top-list',compact('wechatId','voteId','vote','vote_users'));
    }

} 