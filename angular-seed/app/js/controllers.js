'use strict';

/* Controllers */
window.customApply = function (scope, cb) {
if (!scope.$$phase)
scope.$apply(cb);
else
cb();
}


function ConnectCtrl($scope,FBUser) {

	$scope.user = {};
    $scope.user.authorized = false;
  //   $scope.load_friend = function () {
  //   $scope.$apply(function(){
  //  		$scope.user.get_friends();

		// });

  //   };

           
    $scope.fb_login = function() {
  
    			FBUser.login(function(){
            window.customApply($scope,function(){
              $scope.user.authorized = true;
              FBUser.get_friends(function(response){
                window.customApply($scope,function(){
                  $scope.user.friends = response;
                });
               
               });

            });

          },function(){
              $scope.user.authorized = false;
          });

    	};

    $scope.fb_logout = function()  {
    		FBUser.logout(function(){
          window.customApply($scope,function(){
            $scope.user.authorized = false;
          });
        });
    };

console.log($scope.user.friends);
}

ConnectCtrl.$inject = ['$scope', 'FBUser'];