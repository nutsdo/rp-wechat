<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class WechatAuth {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        //获取服务号下的openid，注：回调页需带入本公众号下的openid，带入参数请在自动回复中的url中设置
        //在回调页(业务页)使用带入的openid,获取本公众号下的用户信息。
        if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false ) {
            return "请在微信中打开";
        }

        if(session('logged_user')){
            dd(session('logged_user'));
            if(session('logged_user')->data){
                return redirect()->route('wechat.authorize',$request->route('wechat'));
            }
            return $next($request);
        }else{
            if($request->ajax()){
                return response()->json([
                    'msg'=>'请关注公众号！',
                    'status'=>'error'
                ]);
            }else{
                return redirect()->route('wechat.authorize',$request->route('wechat'));
            }
        }
	}

}
