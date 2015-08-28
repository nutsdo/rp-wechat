<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 8/12/15
 * Time: 11:33 AM
 */
 ?>
 <!DOCTYPE >
 <HTML>
 <HEAD>
 <meta content="text/html; charset=gb2312" http-equiv="Content-Type">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <STYLE type="text/css">
    body{position:relative;margin:0;}
 </STYLE>
 <TITLE>{{$vote->name}}</TITLE>
    {!! Html::style('style/assets/css/bootstrap.css') !!}
    {!! Html::style('style/html/css/main.css') !!}
    {!! Html::style('style/html/css/public.css') !!}
    {!! Html::style('style/html/css/js.itobe.cn.css') !!}
    {!! Html::script('style/assets/js/jquery-1.11.1.min.js') !!}
    {!! Html::script('style/assets/js/bootstrap.min.js') !!}
    {!! Html::script('style/html/js/waterfall.js') !!}
 </HEAD>
 <body>
    <!--顶部悬浮层-->
    @if($user=='')
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
     @endif
   	 <!--搜索框-->
   	 <div class="container">
         <form class="form-search form">
            <input type="text" class="input-medium search-query text" placeholder="输入编号快速查找">
            <button type="submit" class="btn mybtn">搜索</button>
         </form>
     </div>
     <!--展示图片部位-->
     <a href="#">
         {!! Html::image($vote->pic_url,null,['class'=>'bar']) !!}
     </a>
     <div class="info">
    	 {!! Html::image('style/html/imges/Main_03.jpg',null,['class'=>'icon']) !!}
     	 <span>截止目前参加报名人数[{{$vote->join_count}}]人，投票人数[{{$vote->vote_count}}]人</span>
     </div>

 <!--瀑布流main部分-->

 <DIV id="waterfall"  id="masonry">
    @foreach($vote->players as $player)
 	<DIV class="cell thumbnail mar mar1">
 		<a href="{{ route('ucenter.wechat.vote.user.info',[$wechatId,$voteId,$player->id]) }}">
 		{!! Html::image($player->image_url) !!}
 		</a>
 		<div class="caption mes">
             <span class="pull-left">{{$player->join_number}}号参赛</span><span class="pull-right">No.{{$player->join_number}}</span><br>
             <span class="pull-left">{{$player->nickname}}</span><span class="pull-right">{{$player->voted_count}}票</span>
             <!-- Button trigger modal -->
             <button type="button" class="btn btn-primary btnbj" data-toggle="modal" data-event="vote" data-player_id="{{$player->id}}" data-vote_url="{{route('ucenter.wechat.vote.user.voting',[$wechatId,$vote->id,$player->id])}}">
                 投票
             </button>
         </div>
 	</DIV>
 	@endforeach
 </div>
<div id="openid" data-userid="{{ $user }}" style="display:none" ></div>
<!--底部悬浮层-->
 <div class="page-header-fixed">
 <div class="navbar navbar-inverse navbar-fixed-bottom color">
     <div class="navbar-inner">
        <div class="col-xs-5 colxs center">
            <div class="container con">
                    <a href="{{route('ucenter.wechat.vote.user.create',[$wechatId,$vote->id])}}">
                    {!! Html::image('style/html/imges/other_ren.png') !!}
                    立即报名</a>
             </div>
         </div>
        <div class="col-xs-2 sm">
            {!! Html::image('style/html/imges/other_shu.png') !!}
        </div>
        <div class="col-xs-5 colxs center">
            <div class="container con cons">
                <a href="{{route('ucenter.wechat.vote.toplist',[$wechatId,$vote->id])}}">{!! Html::image('style/html/imges/other_05.png') !!}全部排名</a>
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

{!! Html::script('style/html/js/jquery.wechat-vote.js') !!}
<script>

$('button[data-event="vote"]').click(function(){
    var vote_url = $(this).data('vote_url');
    var openid = $('#openid').data('userid');
    $.ajax({
        type:'POST',
        url:vote_url,
        data:{
            'openid':openid
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
 <script  type="text/javascript">
 <!--随页面滚动而不动-->
 $(function(){
 		   $(window).scroll(function(){
 			var h = $(this).scrollTop();
 			$("#wrap").css("top",h);
 		   });
 		});
 		function yincang(){
 			document.getElementById("wrap").style.display="none";
 		};

 var opt={
   getResource:function(index,render){//index为已加载次数,render为渲染接口函数,接受一个dom集合或jquery对象作为参数。通过ajax等异步方法得到的数据可以传入该接口进行渲染，如 render(elem)
 	  if(index>=7) index=index%7+1;
 	  var html='';
 	  var page = 2;
 	  $.ajax({
              type:'GET',
              url:'?page='+page,
              success:function(data){
                ++page;
                html +=data;
              },
              dataType:'json'
          });

 	  return render(html);
   },
   auto_imgHeight:true,
   insert_type:1
 }
 $('#waterfall').waterfall(opt);
 </script>
 </body>
 </html>
