'use strict';

/**
 * @ngdoc function
 * @name cubicle20App.controller:NewProjectCtrl
 * @description
 * # NewProjectCtrl
 * Controller of the cubicle20App
 */
var app = angular.module('cubicle20App');

app.controller('NewProjectCtrl', function ($scope, $http, ModalService, $rootScope) {

    $rootScope.milestones = [];

    $scope.balls = "Man";
    $scope.project_name = "";
    $scope.project_desc = "";
    $scope.project_fee = "";
    $scope.project_ini_payment = "";
    $scope.project_balance_payment = "";
    $scope.project_start = "";
    $scope.project_end = "";

    $scope.post_data = [];
    $scope.post_data_delivery = [];

    $scope.delay = 0;
  	$scope.minDuration = 0;
  	$scope.message = 'Please Wait...';
  	$scope.backdrop = true;
  	$scope.promise = null;

    $scope.showMilestonesDialog = function (){
      //alert("Bass");
      ModalService.showModal({
        templateUrl: "views/addmilestones.html",
        controller: "AddMilestoneCtrl"
      })
    }

    $scope.deck = function (){
      alert("Bass");
    }

    $scope.createProject = function (){
      $scope.post_data.push({
        name: $scope.project_name, desc: $scope.project_desc, fee: $scope.project_fee, ini_payment: $scope.project_ini_payment, balance_payment: $scope.project_balance_payment, start_date: $scope.project_start, end_date: $scope.project_end, milestones: $rootScope.milestones
      });

      $scope.post_data_delivery.push({
        data: $scope.post_data
      });

      //var data = $scope.post_data;

      $scope.promise = $http.post('api/createproject', {payload: $scope.post_data}).success(function(data){
      //data;
           $scope.bought_ticket = true;

      });
    }

  });


app.controller('AddMilestoneCtrl', function ($scope, $http, close, $rootScope) {

  $scope.tasks = [];

  $scope.task = "";

  $scope.users = "";

  $scope.m_name = "";

  $scope.close = function() {
 	  close(); // close, but give 500ms for bootstrap to animate
  };

  $scope.addTask = function() {
    $scope.tasks.push({
        task_name: $scope.task
    });

    $scope.users = angular.element("#project_people").tagsinput('items');
    //console.log($scope.users);
    //console.log($scope.tasks);
    $scope.task = "";
  };

  $scope.addMilestone = function(){
    $rootScope.milestones.push({
      name: $scope.m_name,
      users: $scope.users,
      tasks: $scope.tasks
    });

    close();
    //console.log($rootScope.milestones);
  }

});

app.directive('myEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if(event.which === 13) {
                scope.$apply(function (){
                    scope.$eval(attrs.myEnter);
                });

                event.preventDefault();
            }
        });
    };
});
