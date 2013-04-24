'use strict';

/* Controllers */

// angular.module('myApp.controllers', ['myApp.services']).
//   controller('MainCtrl', ['$scope', 'FBUser',function($scope, FBUser) {
//   	$scope.user = FBUser;
// }]);

function ConnectCtrl($scope,FBUser) {

    $scope.user = FBUser;
    // $scope.friends = FBUser.loadFriends;


}

ConnectCtrl.$inject = ['$scope', 'FBUser'];