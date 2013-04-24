'use strict';
function ConnectCtrl(facebook, $scope, $resource) {

    $scope.user = {};
    $scope.error = null;

    $scope.registerWithFacebook = function() {
        facebook.askFacebookForAuthentication(

        function(reason) { // fail
            $scope.error = reason;
        }, function(user) { // success
            $scope.user = user;
        });
    };
}

ConnectCtrl.$inject = ['facebook', '$scope', '$resource'];