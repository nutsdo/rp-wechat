<!doctype html>
<html lang="zh" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="_token" content="{!! csrf_token() !!}"/>
	<link href='http://fonts.useso.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
	{!! Html::style('style/activity/css/reset.css') !!}
	{!! Html::style('style/activity/css/style.css') !!}
	{!! Html::script('style/activity/js/modernizr.js') !!}
	{!! Html::script('style/activity/js/jquery-1.8.0.min.js') !!}
	{!! Html::script('style/activity/js/timer.js') !!}
	{!! Html::script('style/activity/js/main.js') !!}
</head>

<body>
    <header>
        <h1>小队友绝不可错过的免费午餐！<br>秒？秒！妙！<br>秒到就是你的！<br>秒杀霸王餐!   {{date('Y/m/d h:i:s',$event->start_at)}}开始</h1>
    </header>
    <div class="djs">
        <P>距活动开始还有：</P>
        <div id="fnTimeCountDown" data-end="{{date('Y/m/d H:i:s',$event->start_at)}}">
            <span class="hour">00</span>时
            <span class="mini">00</span>分
            <span class="sec">00</span>秒
        </div>
    </div>
    <a href="#0" class="cd-popup-trigger" >秒&nbsp;&nbsp;杀</a>
    <div class="cd-popup" role="alert">
        <div class="cd-popup-container">
            <p id="text"></p>
           	<p id="cdkey"></p>
            <a href="#0" class="cd-popup-close img-replace">Close</a>
        </div> <!-- cd-popup-container -->
    </div> <!-- cd-popup -->
    {!! Form::open(['route'=>'activity.start','role'=>'form','id'=>'activity']) !!}
    {!! Form::hidden('event_id',$event->id) !!}
    {!! Form::hidden('award_id',$award->id) !!}
    {!! Form::close() !!}
    <script type="text/javascript">
    	$("#fnTimeCountDown").fnTimeCountDown("");
	</script>
</body>
</html>