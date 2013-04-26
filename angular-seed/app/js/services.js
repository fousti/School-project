'use strict';

/* Services */

  window.customApply = function (scope, cb) {
    if (!scope.$$phase)
      scope.$apply(cb);
    else
      cb();
  }

// Demonstrate how to register services
// In this case it is a simple value service.
angular.module('myApp.services', []).service('facebook', function ($window) {

  // this.askFacebookForAuthentication = function (fail, success) {
  //   FB.login(function (response) {
  //     $rootScope.$apply(function () {
  //       if (response.authResponse) {
  //     		FB.api('/me?fields=id,name,friends', function(response){

  //           this.access_token = response.access_token;
  //        });
  //       } else {
  //         console.log('User cancelled login or did not fully authorize.');
  //       }
  //     });
  //   });
  // };

  this.getLoginStatus = function () {
    FB.getLoginStatus(function (response) {
      return response;
    });
  };

  this.FB = $window.FB;

}).service('FBUser',function ($log,facebook) {
  var that = this;


  facebook.FB.Event.subscribe('auth.authResponseChange', function (response) {
    // $log.info("Event: auth.authResponseChange");
    if (response.authResponse) {
      if (response.status === 'connected') {
        // User logged in and authorized
        $log.info('User logged in and authorized');
    
          that.authorized = true;
   


        //     facebook.FB.api('/me?fields=id,name,friends', function(response){
        //     that.name = response.name;
        //     that.friends = response.friends;
        //     console.log('toto');


        // });


      } else if (response.status === 'not_authorized') {
        // User logged in but has not authorized app
        $log.info('User logged in');
      
          that.authorized = false;

      } else {
        // User logged out
        $log.info('User logged out');
       
          that.authorized = false;
   
      }
    } else {
      $log.info('No valid authResponse found, user logged out');
      
        that.authorized = false;
    
    }
  });

  // this.loadFriends = function()
  //   {    
  //     console.log(facebook.accessToken);

  //     FB.api("/"+facebook.uid+"/friends?fields=name,picture.type(square)", function(response)
  //         {
  //          $rootScope.$apply(function(){

  //           if (response) {

  //             that.friends = response;
              
  //           }
  //           else
  //           {
  //             that.friends = {error: "FRIENDS_FAIL", message: "Facebook friends error: " + response};
  //           }
  //         });
  //     });
  //   };

  this.get_friends = function() {
    FB.api('/me?fields=id,name,friends', function(response){
              console.log(response);
        return response;

    });
 };
 
  this.login = function (success, fail) {
    facebook.FB.login(function (response) {

        if (response.authResponse) {
          success(response);
        } else {
          fail('Login unsuccessful');
        }
    });
  };

  this.logout = function (cb) {
    facebook.FB.logout(function () {
        cb();
    });
  };
  
});