'use strict';

/**
 * @ngdoc function
 * @name spectralApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the spectralApp
 */
angular.module('spectralApp').controller('MainCtrl', function ($scope, $http) {

  $scope.signups = [];

  $http.get('api/signups').success(function (data) {
      $scope.signups = data;

      //$("#big_daddy_bryan").css("display", "block");
  });

});
