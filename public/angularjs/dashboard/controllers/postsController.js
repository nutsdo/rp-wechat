/**
 * Created by lvdingtao on 6/4/15.
 */

var postsController = angular.module('postsController',[]);

postsController.controller('postsListCtrl',function($scope, $http, Posts){
    $scope.hello = '你好';

    $scope.postsData = {};

    $scope.loading = true;

    //获取所有文章，并绑定到$scope.posts对象上
    Posts.get()
        .success(function(data){
            $scope.posts = data;
            $scope.loading = false;
        });

    //处理提交表单
    $scope.submitPosts = function(){
        $scope.loading = true;

        //保存
        Posts.save($scope.postsData)
            .success(function(data){
                Posts.get()
                    .success(function(getData){
                        $scope.posts = getData;
                        $scope.loading = false;
                    });
            })
            .error(function(data){
                console.log(data);
            });
    }

    //处理删除的函数
    $scope.deletePost = function(id){

        $scope.loading =true;

        Posts.destroy(id)
            .success(function(data){

                Posts.get()
                    .success(function(getData) {
                        $scope.posts = getData;
                        $scope.loading = true;
                    });
            });
    }

});