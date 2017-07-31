<?php
require_once( 'CafeteriaApp.Backend/Controllers/OrderItem.php');




if ($_SERVER['REQUEST_METHOD']=="GET") {
  if (isset($_GET["action"]) && $_GET["action"]=="getOrderItems"){
    getOrderItems($conn);
  }
  else {
    echo "Error occured while returning OrderItems";
  }
}

if ($_SERVER['REQUEST_METHOD']=="POST"){
    //decode the json data
    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->action) && $data->action == "addOrderItem"){
      if ($data->Name != null){
        addOrderItem($conn,$data->Name);
      }
      else{
        echo "name is required";
      }
  }
}

if ($_SERVER['REQUEST_METHOD']=="PUT"){
    //decode the json data
    $data = json_decode(file_get_contents("php://input"));
    //echo $data;
      if ($data->Name != null && $data->Id != null) {
        //if ($data->action == "addcafeteria"){
        editOrderItem($conn,$data->Name,$data->Id);
      }
      else{
        echo "name is required";
      }
  //}
}

 ?>