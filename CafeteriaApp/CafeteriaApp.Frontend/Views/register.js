//var app = angular.module('myapp', []);

app.controller('Register', function($scope,$http){

$scope.image = null;
$scope.imageFileName = '';
  
  $scope.uploadme = {};
  $scope.uploadme.src = '';

$scope.checkExistingMailAndUserName=function () {

var data = {                   //date need to be updated also
        userName: $scope.userName,
        email: $scope.email
      };

       $http.post('/CafeteriaApp.Backend/Requests/Register.php',data) 
    .then(function(response) {

     // document.getElemntById('emailConfirm').innerHtml= response.data;
  console.log(response);
    if(response.data === "")
    {  //console.log(response);
      $scope.registerfn();
     
    }
    else{
      alertify.error(response.data);
      return false;

    }
   });
    
}


$scope.registerfn=function () {

//if($scope.checkExistingMailAndUserName()){
//if($scope.userName!=null && $scope.password!=null && $scope.firstName!=null && $scope.lastName!=null && $scope.email!=null&& $scope.phone!=null )
//{

	var data = {                   //date need to be updated also
        userName: $scope.userName,
        firstName: $scope.firstName,
        lastName:$scope.lastName,
        phone:$scope.phone,
        email: $scope.email,
    image: $scope.uploadme.src.split(',')[1],
        gender:$scope.gender,
       dob:$scope.DOB,
		password:$scope.password

      };
 //console.log(data);
 $http.put('/CafeteriaApp.Backend/Requests/Register.php',data) 
 .then(function(response) {
     // console.log(response);
     document.location=response.data;
   });
   

//}
//}

}




});

