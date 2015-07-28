<?php
/**
 * Created by PhpStorm.
 * 回复tab
 * User: lvdingtao
 * Date: 7/18/15
 * Time: 9:20 AM
 */
 ?>
 <nav class="navbar navbar-inverse" role="navigation">
     <!-- Brand and toggle get grouped for better mobile display -->
     <div class="navbar-header">
         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
             <span class="sr-only">Toggle navigation</span>
             <i class="fa-bars"></i>
         </button>
         <a class="navbar-brand">素材管理</a>
     </div>

     <!-- Collect the nav links, forms, and other content for toggling -->
     <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
         <ul class="nav navbar-nav">
             <li @if(Request::route('type')=='news') class="active" @endif>
                 <a href="{{route('ucenter.wechat.media.type',[$wechatId,'news'])}}">图文消息</a>
             </li>
             <li>
                 <a href="#">图片库</a>
             </li>
             <li>
                 <a href="#">语音</a>
             </li>
             <li>
                  <a href="#">视频</a>
              </li>
         </ul>
     </div>
     <!-- /.navbar-collapse -->
 </nav>