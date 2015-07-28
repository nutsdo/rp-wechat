/**
 * Created by lvdingtao on 7/9/15.
 */
var postsService = angular.module('postsService',[]);

postsService.factory('Posts',function($http){

    return {
        //get all the posts
        get: function() {
            return $http.get('/posts');
        },

        save: function(postsData) {
            return $http({
                method: 'POST',
                url: '',
                headers: {},
                data: $.param(postsData)
            });
        },

        destroy : function(id) {
            return $http.delete('posts/' + id + '/delete');
        }
    }
});