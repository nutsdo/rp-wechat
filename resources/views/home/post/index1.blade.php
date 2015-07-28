<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 5/15/15
 * Time: 11:54 AM
 */
 ?>

 {!! $posts->render() !!}

 {!! Html::script('style/assets/js/jquery-1.11.1.min.js') !!}
 <script>


 $(document).ready(function() {
     $(document).on('click', '.pagination a', function (e) {
         var currentpage = $(this).attr('href').split('page=')[1];
         var page = window.location.hash.replace('#', '');
         if(currentpage!=page){
            getPosts(currentpage);
         }else{
            return false;
         }

         e.preventDefault();
     });
 });

 function getPosts(page) {
     $.ajax({
         url : '?page=' + page,
         dataType: 'json'
     }).done(function (data) {
         $('.content').append(data);
         location.hash = page;
     }).fail(function () {
         alert('Posts could not be loaded.');
     });
 }

 </script>