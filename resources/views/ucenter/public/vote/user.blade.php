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
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
     <title>投票排行榜</title>

    {!! Html::style('style/assets/css/bootstrap.css') !!}
    {!! Html::style('style/html/css/public.css') !!}
    {!! Html::style('style/html/css/Result.css') !!}

    {!! Html::style('style/html/css/main.css') !!}

    {!! Html::script('style/assets/js/jquery-1.11.1.min.js') !!}
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
     <a href="#">{!! Html::image($vote->pic_url,null,['class'=>'bar'])!!}</a>
     <div class="info">
        {!! Html::image('style/html/imges/Main_03.jpg',null,['class'=>'icon'])!!}
     	<span>截止目前参加报名人数[{{ $vote->join_count }}]人，投票人数[{{ $vote->vote_count }}]人</span>
     </div>
 	<!--主体-->
 	<div class="container mag-bom">
 		<div class="kuang">
 			<div class="heade">
 				<p>{{ $user->join_number }}号&nbsp;{{ $user->nickname }}</p>
 			</div>
 			<div class="container zhai">
 				<div class="piao">{{ $user->voted_count }}票</div>
 				<div class="pa">&nbsp;</div>
 				<div class="piao">第{{ $ranking }}名</div>
 			</div>
 			<div class="container zhai">

 				<div class="photo">
 				    @if($user->pic_url)
 				        {!! Html::image($user->pic_url)!!}
                    @endif
 				</div>

 			</div>
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
                     		<a href="javascript:;" id="voting" data-vote_url="{{route('ucenter.wechat.vote.user.voting',[$wechatId,$vote->id,$user->id])}}">{!! Html::image('style/html/imges/other_xin.png')!!}投TA一票</a>
                         </div>
                     </div>
             </div>
     </div>
     </div>
      <!-- Modal模态窗口 -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
         <div class="modal-dialog kuang" role="document">
             <div class="modal-content">
                 <div class="modal-header m_head">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                      </button>
                      <h4 class="modal-title" id="myModalLabel"></h4>
                  </div>
                  <div class="modal-body center">
                     {!! Html::image('style/html/imges/Main_alert_cuo.png',null,['id'=>'fail','style'=>'display:none']) !!}
                     {!! Html::image('style/html/imges/Apply_s_dui.png',null,['id'=>'success','style'=>'display:none']) !!}
                  </div>
                  <div class="modal-footer  m_foot">
                     <button type="button" name="follow" class="btn btn-primary  btnbj radius">关注公众号，立即参加活动</button>
                  </div>
             </div>
         </div>
     </div>
     <script>

         $('#voting').click(function(){
             var vote_url = $(this).data('vote_url');

             $.ajax({
                 type:'POST',
                 url:vote_url,
                 data:{
                     'openid':"{{ $voter }}"
                 },
                 success:function(data){
                     if(data.status=='success'){
                         $('#success').css('display','inline');
                     }else{
                         $('#fail').css('display','inline');
                     }
                     $('button[name=follow]').text(data.msg);
                     $('#myModal').modal('show');
                 },
                 dataType:'json'
             });
         });

     </script>


    {!! Html::script('style/assets/js/bootstrap.min.js') !!}
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