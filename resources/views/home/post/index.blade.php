<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 5/15/15
 * Time: 11:54 AM
 */
 ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="description" content="{{$node->description}}">
<meta name="title" content="{{$node->title}}">
 {!! Html::style('style/html/css/style.css') !!}

<title>{{$node->title}}</title>
</head>
<body>
    <div class="top">@if(!empty($node)){!! html::image($node->photo) !!}@endif</div>
    <ul id="content" class="content" id="thelist">
      @foreach($posts as $post)
      <li class="img1">
        <img src="{{$post->photo}}"/>
        <p class="zi1"><a href="{{$post->post_url}}">{{$post->title}}</a></p>
        <p class="zi2">{{$post->shop_name}}</p>
        <a href="{{$post->post_url}}"><span></span></a>
      </li>
      @endforeach
    </ul>
    <a id="next" href="{{$posts->nextPageUrl()}}"></a>
    {!! Html::script('style/html/js/jquery-1.8.0.js') !!}
    {!! Html::script('style/html/js/jquery.infinitescroll.js') !!}


<script>

	$('#content').infinitescroll({

		// callback		: function () { console.log('using opts.callback'); },
		navSelector  	: "a#next:last",
		nextSelector 	: "a#next:last",
		itemSelector 	: "#content li",
		debug		 	: true,
		loading: {
            finished: undefined,
            finishedMsg: '没有更多内容了...',
            img: '/../style/html/imges/loading.gif',
            msg: null,
            msgText: "<a>加载中...</a>",
            selector: null,
            speed: 'fast',
            start: undefined
          },
        path:['?page=',''],
		dataType	 	: 'json',
		behavior		: 'twitter',
		appendCallback	: false, // USE FOR PREPENDING
		maxPage         :100,
		//pathParse     	: function( pathStr, nextPage ){ return pathStr.replace('2', nextPage ); }
    }, function( response ) {
    	var jsonData = response;
            $theCntr = $("#content");
            $theCntr.append(jsonData);
        });
	</script>

</body>
</html>
