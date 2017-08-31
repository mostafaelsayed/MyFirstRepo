layoutApp.controller('cafeterias',['$scope','$http',function($scope,$http) {

  $scope.getCafeterias = function() {

    $http.get('/CafeteriaApp.Backend/Requests/Cafeteria.php')
    .then(function (response) {
      console.log(response);
      $scope.cafeterias = response.data;
    });

  };

  $scope.getCafeterias();

}]);
