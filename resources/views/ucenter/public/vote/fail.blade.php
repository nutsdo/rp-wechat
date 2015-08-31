<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 8/13/15
 * Time: 2:51 PM
 */
 ?>
 <!DOCTYPE html>
 <html lang="zh-CN">
   <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0;">
     <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
     <title>报名失败</title>


     <!-- Bootstrap -->
     {!! Html::style('style/assets/css/bootstrap.css') !!}
     {!! Html::style('style/html/css/Apply.css') !!}

     <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
     <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   </head>
   <body>
 	<!--报名失败-->
 	<div class="container ">
 		<div class="bigimg">{!! Html::image('style/html/imges/Apply_f_bai.png') !!}</div>
 		<div class="tishi1">
 		    <p>报名失败</p>
 		    @if($msg)<p>{{ $msg }}</p>@endif
 		    <p>@if($status=='no_start') 活动未开始 @elseif($status=='end') 活动已结束  @endif</p>
 		</div>
 		<div class="mybtn1">
 		@if($status)
 		    <a class="btn btn-default btn-lg false" href="{{route('ucenter.wechat.vote.show',[$wechatId,$voteId]).'/'.$voter}}" role="button">返回首页</a>
 		@else
 			<a class="btn btn-default btn-lg false" href="{{route('ucenter.wechat.vote.user.create',[$wechatId,$voteId])}}" role="button">返回报名</a>
 		@endif
 		</div>
 	</div>

   </body>
 </html>