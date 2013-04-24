'use strict';

angular.module('myApp.services', []).service('facebook', function($rootScope) {
    this.askFacebookForAuthentication = function(fail, success) {
        FB.login(function(response) {
            $rootScope.$apply(function() {
                if (response.authResponse) {
                    FB.api('/me', success);
                } else {
                    fail('User cancelled login or did not fully authorize.');
                }
            });
        });
    };
});