<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 8/13/15
 * Time: 3:11 PM
 */
 ?>
 <!DOCTYPE html>
 <html lang="zh-CN">
   <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0;">
     <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
     <title>投票排行榜</title>

    {!! Html::style('style/assets/css/bootstrap.css') !!}
    {!! Html::style('style/html/css/public.css') !!}
    {!! Html::style('style/html/css/Result.css') !!}

    {!! Html::script('style/assets/js/jquery-1.11.1.min.js') !!}
    {!! Html::script('style/assets/js/bootstrap.min.js') !!}
   </head>
   <body>
   <!--顶部悬浮层-->
     <div id="wrap">
         <div class="modal-dialog fudong" role="document">
             <div class="modal-content quyuanjiao">
                 <div class="modal-header text-center border">
                     <button type="button" class="btn btn-primary bjcol radius">关注公众号，立即参加活动</button>
                     <button id="btn" type="button" class="close center ct" data-dismiss="modal" aria-label="Close" onClick="yincang()">
                     	<span aria-hidden="true">&times;</span>
                     </button>
                 </div>
             </div>
         </div>
     </div>
 	<!--导航位置-->
 	<div class="nav">
 		<div class="col-xs-2">
 		<a href="{{route('ucenter.wechat.vote.show',[$wechatId,$vote->id])}}">
 		    {!! Html::image('style/html/imges/Apply_jiantou.png')!!}
 		</a>
 		</div>
 		<div class="col-xs-10 pad">
 		<span><a href="{{route('ucenter.wechat.vote.show',[$wechatId,$vote->id]).'/'.$voter}}">返回首页</a></span>
 		</div>
 		</div>
 	</div>
     <!--展示图片部位-->
     <a href="#">{!! Html::image('style/html/imges/Main_bimg.png',null,['class'=>'bar'])!!}</a>
     <div class="info">
        {!! Html::image('style/html/imges/Main_03.jpg',null,['class'=>'icon'])!!}
     	<span>截止目前参加报名人数[{{ $vote->join_count}}]人，投票人数[{{ $vote->vote_count}}]人</span>
     </div>
	<!--表格-->
	<div class="container main">
	<table class="table">
	  <thead>
		<tr>
		  <th>排名</th>
		  <th>昵称</th>
		  <th>编号</th>
		  <th>票数</th>
		</tr>
	  </thead>
	  <tbody>
	  @foreach($vote_users as $key=>$user)
		<tr class="info">
			<td>{{ $key+1 }}</td>
			<td><a href="{{ route('ucenter.wechat.vote.user.info',[$wechatId,$vote->id,$user->id]) }}">{{ $user->nickname }}</a></td>
			<td>{{ $user->id }}</td>
			<td>{{ $user->voted_count }}</td>
		</tr>
	  @endforeach
	  </tbody>
	</table>
	<div>
	    {{$vote_users->render()}}
	</div>
	</div>
 	<!--底部悬浮层-->
     <div class="page-header-fixed">
     <div class="navbar navbar-inverse navbar-fixed-bottom color">
         <div class="navbar-inner">
            <div class="col-xs-5 colxs">
                <div class="container con">
                        <a href="{{route('ucenter.wechat.vote.user.create',[$wechatId,$vote->id])}}">{!! Html::image('style/html/imges/other_ren.png')!!}立即报名</a>
                 </div>
             </div>
            <div class="col-xs-2 sm">
                {!! Html::image('style/html/imges/other_shu.png')!!}
             </div>
            <div class="col-xs-5 colxs">
                <div class="container con cons">
                    <a href="#">{!! Html::image('style/html/imges/other_05.png')!!}全部排名</a>
                 </div>
            </div>
         </div>
     </div>
     </div>

     <!--随页面滚动而不动-->
 	<script type="text/javascript">
 		$(function(){
 		   $(window).scroll(function(){
 			var h = $(this).scrollTop();
 			$("#wrap").css("top",h);
 		   });
 		});
 		function yincang(){
 			document.getElementById("wrap").style.display="none";
 		}
 	</script>
   </body>
 </html>