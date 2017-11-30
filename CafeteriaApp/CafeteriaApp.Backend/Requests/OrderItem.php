<?php

require_once('CafeteriaApp/CafeteriaApp/CafeteriaApp.Backend/Controllers/OrderItem.php');
require_once('CafeteriaApp/CafeteriaApp/CafeteriaApp.Backend/connection.php');
require_once('TestRequestInput.php');

if ($_SERVER['REQUEST_METHOD'] == "GET") {
  if ( isset($_GET["orderId"]) && test_int($_GET["orderId"]) )
    checkResult( getOrderItemsByOpenOrderId($conn, $_GET["orderId"]) );
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {
  //decode the json data
  $data = json_decode( file_get_contents("php://input") );

  if ( isset($data->OrderId, $data->MenuItemId, $data->Quantity) && test_int($data->OrderId, $data->MenuItemId, $data->Quantity) ) {
    $orderId = addOrderItem($conn, $data->OrderId, $data->MenuItemId, $data->Quantity);
    if ( !empty($orderId) )
      echo $orderId;
  }
  else {
    echo "error";
  }

}

if ($_SERVER['REQUEST_METHOD'] == "PUT") {
  //decode the json data
  $data = json_decode( file_get_contents("php://input") );
  if ( isset($data->Id, $data->Quantity) && test_int($data->Id, $data->Quantity) )
    editOrderItemQuantity($conn, $data->Quantity, $data->Id, $data->Flag);
}

if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
  if ( isset($_GET["id"]) && test_int($_GET["id"]) )
    deleteOrderItem($conn, $_GET["id"]);
}

require('CafeteriaApp/CafeteriaApp/CafeteriaApp.Backend/footer.php');

?>