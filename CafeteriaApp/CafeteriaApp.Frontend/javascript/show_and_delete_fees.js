var show_and_delete_feesApp = angular.module('show_and_delete_fees', ['modal', 'angularModalService', 'ui.bootstrap']);

show_and_delete_feesApp.controller('showAndDeleteFees',
  ['$scope', '$http', 'ModalService', function($scope, $http, ModalService) {
  	$scope.show = function(fee) {
      ModalService.showModal({
        templateUrl: '/CafeteriaApp/CafeteriaApp/CafeteriaApp.Frontend/Templates/Views/modal.html',
        controller: "ModalController",
        inputs: {
          name: "fee"
        }
    	}).then(function(modal) {
      	modal.element.modal();

      	modal.close.then(function(result) {
        	if (result == "Yes") {
          	$scope.delete(fee);
        	}
      	});
    	});
    };

  	$scope.getFees = function() {
  		$http.get('/CafeteriaApp/CafeteriaApp/CafeteriaApp.Backend/Requests/Fee.php')
  		.then(function(response) {
  			$scope.fees = response.data;
  		});

  	};

  	$scope.getFees();

  	$scope.deleteFee = function(fee) {
      $scope.show(fee);
    };

    $scope.delete = function(fee) {
      $http.delete('/CafeteriaApp/CafeteriaApp/CafeteriaApp.Backend/Requests/Fee.php?feeId=' + fee.Id)
      .then(function(response) {
        $scope.fees.splice($scope.fees.indexOf(fee), 1);
      });
    };
  }]);