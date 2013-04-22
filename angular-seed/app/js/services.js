'use strict';

/* Services */


// Demonstrate how to register services
// In this case it is a simple value service.
angular.module('myApp.services', []).
  run(function($rootScope,Facebook){
  		 $rootScope.Facebook = Facebook;
  }).
  factory('Facebook',function(){
  	   var self = this;
    this.auth = null;

    return {

      getAuth: function() {
        return self.auth;
      },

      login: function() {

        FB.login(function(response) {
          if (response.authResponse) {
            self.auth = response.authResponse;
          } else {
            console.log('Facebook login failed', response);
          }
        })

      },

      logout: function() {

        FB.logout(function(response) {
          if (response) {
            self.auth = null;
          } else {
            console.log('Facebook logout failed.', response);
          }

        })

      }

    }


  })
