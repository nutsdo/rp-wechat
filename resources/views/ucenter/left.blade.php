<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 7/15/15
 * Time: 4:01 PM
 */
 ?>
<!-- Mailbox Sidebar -->
<div class="col-sm-3 mailbox-left">

    <div class="mailbox-sidebar">

        <a href="{{route('ucenter.wechat.create')}}" class="btn btn-block btn-secondary btn-icon btn-icon-standalone btn-icon-standalone-right">
            <i class="fa-plus"></i>
            <span>添加公众号</span>
        </a>


        <ul class="list-unstyled mailbox-list">
            <li class="active">
                <a href="{{route('ucenter.wechat.edit',$wechatId)}}">
                    公众号设置
                    <span class="badge badge-success pull-right">edit</span>
                </a>
            </li>
            <li>
                <a href="{{route('ucenter.wechat.media',$wechatId)}}">
                    素材管理
                    <span class="badge badge-success pull-right"></span>
                </a>
            </li>
            <li>
                <a href="{{route('ucenter.wechat.reply',$wechatId)}}">
                    自动回复
                </a>
            </li>
            <hr/>
        </ul>

        <div class="vspacer"></div>

        <ul class="list-unstyled mailbox-list">
            <li class="list-header">高级功能</li>
            <li>
                <a href="{{route('ucenter.wechat.module.index',$wechatId)}}">
                    模块管理
                    <span class="badge badge-success badge-roundless pull-right upper">Module</span>
                </a>
            </li>
            <li>
                <a href="{{route('ucenter.wechat.vote.index',$wechatId)}}">
                    投票
                    <span class="badge badge-success badge-roundless pull-right upper">Vote</span>
                </a>
            </li>
            <li>
                <a href="#">
                    微官网
                    <span class="badge badge-red badge-roundless pull-right upper">Friends</span>
                </a>
            </li>
            <hr />
        </ul>

    </div>

</div>