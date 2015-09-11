<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 9/11/15
 * Time: 10:06 AM
 */
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <title></title>
 </head>
 <body>

 </body>
 {!! Html::script('http://res.wx.qq.com/open/js/jweixin-1.0.0.js')!!}

 <script>
     wx.config({!! $wechatJs !!});
     wx.ready(function(){
         // 1 判断当前版本是否支持指定 JS 接口，支持批量判断
           document.querySelector('#checkJsApi').onclick = function () {
             wx.checkJsApi({
               jsApiList: [
                 'getNetworkType',
                 'previewImage'
               ],
               success: function (res) {
                 alert(JSON.stringify(res));
               }
             });
           };
     });
 </script>

<button id="checkJsApi">测试js</button>
 </html>
