<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 5/15/15
 * Time: 3:15 PM
 */
?>
@foreach($posts as $key=>$post)
<li class="img1">
<p class="zi1"><a href="{{$post->post_url}}">{{$post->title}}</a></p>
<p class="zi2">{{$post->shop_name}}</p>
<a href="{{$post->post_url}}"><img src="{{$post->photo}}"/></a>
  <span></span>
</li>
@endforeach