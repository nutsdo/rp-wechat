<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 8/13/15
 * Time: 2:07 PM
 */

namespace App\Repositories\WechatRepositories;


use App\VoteUsers;

class VoteUserRepository {

    public function create($request,$wechatId,$voteId)
    {
        $file = $request->file('image_url');
        if($file->isValid()){
            $extension = $file->getClientOriginalExtension();//取得上传文件的后缀名
            $fileName = uniqid().'_vote.'.$extension;  //设置文件名
            //设置保存文件路径
            $path = 'uploads/vote/'.date('Ymd',time());
            is_dir($path) || mkdir($path,null,true); //如果目录不存在则创建
            $file->move($path,$fileName);
            $fullFileName = $path.'/'.$fileName;
        }
        $join_number = VoteUsers::where('vote_id','=',$voteId)->count();
        return VoteUsers::create([
            'join_number'=> $join_number+1,
            'vote_id'=>$voteId,
            'nickname'=>$request->all()['nickname'],
            'phone'=>$request->all()['phone'],
            'image_url'=>$fullFileName,
            'join_body'=>$request->all()['join_body'],
        ]);
    }
}