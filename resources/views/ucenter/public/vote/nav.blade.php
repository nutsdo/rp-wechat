<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 8/11/15
 * Time: 10:32 AM
 */
 ?>
 <nav class="navbar navbar-inverse" role="navigation">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
              <span class="sr-only">投票功能</span>
              <i class="fa-bars"></i>
          </button>
          <a class="navbar-brand">投票</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
          <ul class="nav navbar-nav">
              <li class="active">
                  <a href="{{route('ucenter.wechat.vote.create',$wechatId)}}">新建投票</a>
              </li>
          </ul>
      </div>
      <!-- /.navbar-collapse -->
 </nav>