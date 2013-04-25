'use strict';

/* Controllers */

// angular.module('myApp.controllers', ['myApp.services']).
//   controller('MainCtrl', ['$scope', 'FBUser',function($scope, FBUser) {
//   	$scope.user = FBUser;
// }]);

function ConnectCtrl($scope,FBUser) {

    $scope.user = FBUser;
    $scope.load_friend = function () {
    $scope.$apply(function(){
    		$scope.user.FB.api('/me?fields=id,name,friends', function(response){
	            $scope.user.name = response.name;
	            $scope.user.friends = response.friends;
       		 });

		});

    };

    $scope.fb_login = function(FBuser) {
    	$scope.FBuser.login($scope.load_friend);


    };
    $scope.fb_logout = function(FBuser)  {
    	$scope.FBuser.logout();
    };


}

ConnectCtrl.$inject = ['$scope', 'FBUser'];