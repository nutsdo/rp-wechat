<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 8/13/15
 * Time: 9:29 AM
 */
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>报名</title>
    {!! Html::style('style/assets/css/bootstrap.css') !!}
    {!! Html::style('style/html/css/Apply.css') !!}
    {!! Html::style('style/html/css/bootstrap.file-input.css') !!}

    {!! Html::style('style/assets/css/xenon-core.css') !!}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
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
        <a href="{{route('ucenter.wechat.vote.show',[$wechatId,$voteId])}}">{!! Html::image('style/html/imges/Apply_jiantou.png') !!}</a>
    </div>
    <div class="col-xs-10 pad">
        <span><a href="{{route('ucenter.wechat.vote.show',[$wechatId,$voteId]).'/'.$voter}}">返回首页</a></span>
    </div>
</div>
</div>
<!--警告提示-->
<div class="info">
    <span>带*号为必填项<br>请务必填写正确的手机号码，以便获奖后第一时间联系您</span>
</div>
<!--表单-->
<div class="container ">

    {!! Form::open(['route'=>['ucenter.wechat.vote.user.store',$wechatId,$voteId],'role'=>'form','class'=>'validate','enctype'=>"multipart/form-data"]) !!}
        {!! Form::hidden('open_id',$voter) !!}
        <div class="form-group @if($errors->first('nickname')) has-error @endif">
            <label for="nickname">* 昵称</label>
            <input type="text" class="form-control" name="nickname" id="nickname" placeholder="点击这里输入您的昵称" />
            @if($errors->first('nickname')) {{$errors->first('nickname')}} @endif
        </div>
        <div class="form-group @if($errors->first('phone')) has-error @endif">
            <label for="phone">* 联系方式</label>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="点击这里输入您正确的手机号" />
            @if($errors->first('phone')) {{$errors->first('phone')}} @endif
        </div>
        <div class="form-group @if($errors->first('image_url')) has-error @endif">
            {!! Html::image('style/html/imges/Apply_jia.png') !!}
            <input type="file" id="image_url" name="image_url" class="custom-file-input" />
            @if($errors->first('image_url')) {{$errors->first('image_url')}} @endif
        </div>
        <div class="form-group">
            <label for="join_body">参赛宣言</label>
            <input type="text" class="form-control" name="join_body" id="join_body" placeholder="输入您的参赛宣言" />
        </div>
        <button type="submit" class="btn btn-default btnbj">立即报名</button>
    {!! Form::close() !!}
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {!! Html::script('style/assets/js/jquery-1.11.1.min.js') !!}
    {!! Html::script('style/assets/js/bootstrap.min.js') !!}

    {!! Html::script('style/html/js/bootstrap.file-input.js') !!}

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