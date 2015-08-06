<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 8/6/15
 * Time: 2:33 PM
 */

namespace App\Http\Controllers\Ucenter;


use App\Reply;

class ReplyController extends BaseController{

    public function __construct()
    {
        parent::__construct();
    }

    public function destroy($wechatId,$id)
    {
        $reply = Reply::find($id);
        if($reply->id){
            $reply->delete();
            return response()->json(['status' => 'success', 'msg' => "删除成功！"]);
        }else{
            return response()->json(['status' => 'fail', 'msg' => "删除失败！"]);
        }
    }
} 