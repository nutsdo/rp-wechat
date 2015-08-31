<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 8/13/15
 * Time: 2:19 PM
 */
 ?>
 <!DOCTYPE html>
 <html lang="zh-CN">
   <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0;">
     <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
     <title>恭喜!报名成功~</title>

     <!-- Bootstrap -->
     {!! Html::style('style/assets/css/bootstrap.css') !!}
     {!! Html::style('style/html/css/Apply.css') !!}

     <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
     <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   </head>
   <body>
 	<!--导航位置-->
 	<div class="nav">
 		<div class="col-xs-6">
 		    <span class="pull-left"><a href="{{route('ucenter.wechat.vote.show',[$wechatId,$voteId]).'/'.$voter}}">返回首页</a></span>
 		</div>
 		<div class="col-xs-6">
 		    <span class="pull-right"><a href="{{route('ucenter.wechat.vote.toplist',[$wechatId,$voteId])}}">查看结果</a></span>
 		</div>
 		</div>
 	</div>
 	<!--报名成功-->
 	<div class="container ">
 		<div class="bigimg">{!! Html::image('style/html/imges/Apply_s_dui.png') !!}</div>
 		<div class="tishi"><p>恭喜您,报名成功</p></div>
 		<div class="mybtn">
 			<a class="btn btn-default btn-lg wode" href="#" role="button">向好友拉票</a>
 			<a class="btn btn-default btn-lg wode wode1" href="#" role="button">向朋友圈拉票</a>
 		</div>
 	</div>

   </body>
 </html>