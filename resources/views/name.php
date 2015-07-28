<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 6/5/15
 * Time: 3:49 PM
 */
?>
<div ng-controller="postsListCtrl">

    <div ng-hide="loading" ng-repeat="post in posts">
        <h3>Post #{{ post.id }} <small>by {{ post.title }}</h3>
        <p>{{ post.shop_name }}</p>

        <p><a href="#" ng-click="deletePost(post.id)">Delete</a></p>
    </div>
</div>

