'use strict';

/**
 * @ngdoc overview
 * @name cubicle20App
 * @description
 * # cubicle20App
 *
 * Main module of the application.
 */
angular
  .module('cubicle20App', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngRoute',
    'ngSanitize',
    'ngTouch',
    'angularModalService'
  ])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/main.html',
        controller: 'MainCtrl'
      })
      .when('/new-project', {
        templateUrl: 'views/new.html',
        controller: 'NewProjectCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });
  });
