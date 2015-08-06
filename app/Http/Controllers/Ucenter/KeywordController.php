<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 8/6/15
 * Time: 10:39 AM
 */

namespace App\Http\Controllers\Ucenter;


use App\Keyword;

class KeywordController extends BaseController{

    public function __construct()
    {
        parent::__construct();
    }

    public function destroy($wechatId,$id)
    {
        $keyword = Keyword::whereRaw("wechat_id={$wechatId} and id={$id}")->first();

        if($keyword->id){
            $keyword->delete();
            return response()->json(['status' => 'success', 'msg' => "删除成功！"]);
        }else{
            return response()->json(['status' => 'fail', 'msg' => "删除失败！"]);
        }
    }
} 