'use strict';


// Declare app level module which depends on filters, and services
angular.module('myApp', [ 'myApp.services']).
  config(['$routeProvider', function($routeProvider) {
    $routeProvider.when('/view1', {templateUrl: 'partials/partial1.html', controller: ConnectCtrl });

    $routeProvider.otherwise({redirectTo: '/view1'});
  }]);
