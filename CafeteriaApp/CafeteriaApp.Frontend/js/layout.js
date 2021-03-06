function selectpickerDirective($parse) {
  return {
    restrict: 'A',
    priority: 1000,
    link: function (scope, element, attrs) {
      //New change
      scope.$watch(attrs.ngModel, function(n, o) {
        element.selectpicker( 'val', $parse(n)() );
        element.selectpicker('refresh');
      });
    }
  };
}

var layoutApp = angular.module( 'layout_app', ['customer_and_cashier_order'] );

layoutApp.directive( 'selectPicker', ['$parse', selectpickerDirective] );

layoutApp.controller('Language_Order', ['$rootScope', '$scope', '$http', 'Order_Info',
function($rootScope, $scope, $http, Order_Info) {
    $scope.searchTerm = '';

    $scope.changeLanguage = function(languageId) {
        //$timeout(function () {
        //}, 1000);
        var data = {langId: languageId};

        $http.post('/myapi/Languages', data)
        .then(function(response) {
            location.reload();
            //document.location=<?php //echo "\"{$_SERVER['PHP_SELF']}\"" ;//current executing script , __FILE__ gets the current file?>
        });
        // handle error too
    };

    $scope.search = function() {
        $http.post('/myapi/search?query=' + $scope.searchTerm).then(function(response) {
            $scope.searchResult = response.data;
            console.log(response);
        });
    };

    $scope.selectFromSearchResult = function(res) {
        $http.put('/myapi/search?query=' + res.Name).then(function(response) {
            document.location = '/filtered_data?query=' + res.Name;
        });
    };
   
    Order_Info.getOrderItems($scope.orderId);

    $scope.increaseQuantity = function(OrderItem) {
      Order_Info.increaseQuantity(OrderItem);
    };

    $scope.decreaseQuantity = function(OrderItem) {
      Order_Info.decreaseQuantity(OrderItem);
    };

    $scope.deleteOrderItem = function(OrderItem) {
      Order_Info.deleteOrderItem(OrderItem);
    };
}]);


$(document).ready(function() {
      // if ( $(window).width() < 768 ) {
      //   $('#optionsNavbar').addClass("collapse");
      // }
    // ANIMATEDLY DISPLAY THE NOTIFICATION COUNTER.
    // $('#noti_Counter')
    //     .css({ opacity: 0 })
    //     .text('7')              // ADD DYNAMIC VALUE (YOU CAN EXTRACT DATA FROM DATABASE OR XML).
    //     .css({ top: '-10px' })
    //     .animate({ top: '-2px', opacity: 1 }, 500);

    $('#shoppingCart-btn').click(function() {
        // TOGGLE (SHOW OR HIDE) NOTIFICATION WINDOW.
        $('#shoppingCartDetails').fadeToggle('fast', 'linear', function() {
            if ( $('#shoppingCartDetails').is(':hidden') ) {
                // $('#shoppingCart-btn').css('background-color', '#2E467C');
            }

            // else $('#shoppingCart-btn').css('background-color', '#FFF');        // CHANGE BACKGROUND COLOR OF THE BUTTON.
        });

        // $('#noti_Counter').fadeOut('slow');                 // HIDE THE COUNTER.

        return false;
    });

    // HIDE NOTIFICATIONS WHEN CLICKED ANYWHERE ON THE PAGE.
    // $(document).click(function() {
    //     $('#shoppingCartDetails').hide();
    //     // CHECK IF NOTIFICATION COUNTER IS HIDDEN.
    //     // if ($('#noti_Counter').is(':hidden')) {
    //     //     // CHANGE BACKGROUND COLOR OF THE BUTTON.
    //     //     $('#shoppingCart-btn').css('background-color', '#2E467C');
    //     // }
    // });

    $('#shoppingCartDetails').click(function(e) {
        if (! e.target.matches('#cart_checkout a') )
            return false;       // DO NOTHING WHEN CONTAINER IS CLICKED.
    });

    function toggleNotifications() {
        $('#notifyLabel').html('');
        $("#notifyme").slideToggle("slow");
    }

    $(document).click(function (event) {
        var clickover = $(event.target);
        var $navbar = $(".navbar-collapse");               
        var _opened = $navbar.hasClass("in");

        // check if it's open and we clicked outside the toggle button
        if ( _opened === true && !clickover.hasClass("navbar-toggle") ) {      
            $navbar.collapse('hide');
        }
    });
});