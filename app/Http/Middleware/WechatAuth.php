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
        if(session('openId')){
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
