'use strict';

/* Controllers */

angular.module('myApp.controllers', ['myApp.services']).
  controller('MainCtrl', ['$scope', 'FBUser',function($scope, FBUser) {
  	$scope.user = FBUser;
}]);
