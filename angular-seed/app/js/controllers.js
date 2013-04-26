'use strict';

/* Controllers */



function ConnectCtrl($scope,FBUser) {


	$scope.safeApply = function(fn) {
	  var phase = this.$root.$$phase;
	  if(phase == '$apply' || phase == '$digest') {
	    if(fn && (typeof(fn) === 'function')) {
	      fn();
	    }
	  } else {
	    this.$apply(fn);
	  }
};
	$scope.user = {};
    $scope.user.authorized = false;
  //   $scope.load_friend = function () {
  //   $scope.$apply(function(){
  //  		$scope.user.get_friends();

		// });

  //   };

    $scope.fb_login = function() {
  
    			FBUser.login(function(){
            $scope.safeApply(function(){
              $scope.user.authorized = true;
              $scope.user.friends = FBUser.get_friends();
            });

          },function(){
              $scope.user.authorized = false;
          });

    	};

    $scope.fb_logout = function()  {
    		FBUser.logout(function(){
          $scope.safeApply(function(){
            $scope.user.authorized = false;
          });
        });
    };

console.log($scope.user.friends);
}

ConnectCtrl.$inject = ['$scope', 'FBUser'];