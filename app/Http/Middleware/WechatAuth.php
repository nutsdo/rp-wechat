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
        var_dump(session('logged_user')->data);
        var_dump(session('openid'));
        if(Session::get('logged_user')){
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
