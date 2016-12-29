'use strict';

/**
 * @ngdoc function
 * @name spectralApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the spectralApp
 */
angular.module('spectralApp').controller('MainCtrl', function ($scope, $http, myService) {

  $scope.signups = [];
  $scope.signups_graph = "";
  $scope.search_value = "";
  $scope.arrivals = "";

  $scope.all_signups = 0;

  $scope.first_timer_signups_num = 0;

  $http.get('api/signups').success(function (data) {
      $scope.signups = data;
      $scope.all_signups = $scope.signups.length;
      angular.element("#big_daddy_bryan").css("display", "block");
      angular.element(".loader").css("display", "none");

      //re-forked the damn graph. Phew
      d3.json('api/signups_data', function(data) {
        for (var i = 0; i < data.length; i++) {
            //data[i] = MG.convert.date(data[i], 'date');
        }

        var data_ = MG.convert.date(data, 'date');

        MG.data_graphic({
          title: "Camp Joseph 2016 Registration",
          description: "Feast your eyes on the glorious number of people who registered for Camp Joseph 2016. Bwahahaha. Lol",
          data: data_,//JSON.parse(document.querySelector('.data_signups').innerHTML),
          /*markers: [{'year': 1964, 'label': '"The Creeping Terror" released'}],*/
          width: 400,

          height: 280,
          /*baselines: [{value: 77, label: 'Peak Of Registration'}],*/
          full_height: true,
          full_width: true,
          yax_count: 6,
          max_y: 500,

          target: ".graph",
          x_accessor: "date",
          y_accessor: "signups",
        });
    });
      //$("#big_daddy_bryan").css("display", "block");
  });

  $http.get('api/first_timer_signups').success(function (data) {
      $scope.first_timer_signups_num = data;

      //$("#big_daddy_bryan").css("display", "block");
  });

  $http.get('api/arrivals').success(function (data) {
      $scope.arrivals = data;
  });

  /*$http.get('api/signups_data').success(function (data) {
      $scope.signups_graph = data;

      //$("#big_daddy_bryan").css("display", "block");
  });*/

  $scope.getAllSignups = function(){
    return $scope.all_signups;
  }

  $scope.getArrivals = function(){
    return $scope.arrivals;
  }

  $scope.search = function(){
    NProgress.start();

    var config = {
      headers : {
        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
      }
    }

    var data = $.param({
        search: $scope.search_value
    });
    //return ($scope.signups.length - $scope.first_timer_signups_num);
    $http.post('api/do_search', data, config).success(function (data) {
        //angular.element($event.target).parent().html("<span class='arrived_tag'>Arrived</span>");
        $scope.signups = data;
        NProgress.done();
        //$("#big_daddy_bryan").css("display", "block");
    });
  }

  $scope.getOldSignups = function(){
    return ($scope.all_signups - $scope.first_timer_signups_num);
  }

  $scope.showSignUp = function(){
    if ($scope.search_value == ""){
      NProgress.start();
      $http.get('api/signups').success(function (data) {
          $scope.signups = data;
          $scope.all_signups = $scope.signups.length;
          NProgress.done();
          //$("#big_daddy_bryan").css("display", "block");
      });
    }
  }

  $scope.markAsArrived = function($event, reg_ID){
    NProgress.start();

    var config = {
      headers : {
        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
      }
    }

    var data = $.param({
        ID: reg_ID
    });
    //return ($scope.signups.length - $scope.first_timer_signups_num);
    $http.post('api/mark_arrived', data, config).success(function (data) {
        angular.element($event.target).parent().html("<span class='arrived_tag'>Arrived</span>");
        NProgress.done();
        //$("#big_daddy_bryan").css("display", "block");
    });

  }

  $scope.getDate = myService.getDate;

});


angular.module('spectralApp').directive('myEnter', function () {
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


angular.module('spectralApp').factory('myService', function () {
    return {
        getDate: function (UNIX_timestamp) {
            var a = new Date(UNIX_timestamp * 1000);
            var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            var year = a.getFullYear();
            var month = months[a.getMonth()];
            var date = a.getDate();
            var hour = a.getHours();
            var min = a.getMinutes();
            var sec = a.getSeconds();

            var ampm = hour >= 12 ? 'pm' : 'am';

            min = min < 10 ? '0' + min : min;

            hour = hour % 12;

            var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ampm; // + ':' + sec ;
            return time;
        }
    }
});
