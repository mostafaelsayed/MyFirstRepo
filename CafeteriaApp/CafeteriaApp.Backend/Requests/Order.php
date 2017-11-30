<?php

require('CafeteriaApp/CafeteriaApp/CafeteriaApp.Backend/connection.php');
require('CafeteriaApp/CafeteriaApp/CafeteriaApp.Backend/session.php');
require('CafeteriaApp/CafeteriaApp/CafeteriaApp.Backend/Controllers/Order.php');
#require('CafeteriaApp/CafeteriaApp/CafeteriaApp.Backend/Controllers/Times.php');
require('TestRequestInput.php');
require_once('CafeteriaApp/CafeteriaApp/PayPal/start.php');
require_once('CafeteriaApp/CafeteriaApp/PayPal/pay.php');

//var_dump($_SERVER);
//var_dump($_POST);

if ($_SERVER['REQUEST_METHOD'] == "GET")
{
  if ( isset($_GET["orderId"]) && !isset($_GET["flag"]) && test_int($_GET["orderId"]) )
  {
    $Duration = calcOpenOrderDeliveryTime($conn, $_GET["orderId"]);
    //$time = time("h:i:00") + ($Duration * 60);
    //$time = date("h:i:00", $time);
    $Id = getCurrentTimeId($conn);
    //checkResult( array("Id" => (string)$Id , "Duration" => (string)$Duration) );
    //checkResult( array("Id" => ()$Id) );
  }
  elseif ( isset($_GET["orderId"]) && isset($_GET["flag"]) && test_int($_GET["orderId"],$_GET["flag"]) )
  {
    checkResult( getOrderItems($conn,$_GET["orderId"]) );
  }
  elseif ( isset($_GET['flag']) && test_int($_GET["flag"]) )
  {
    checkResult( getOrders($conn) );
  }
  else
  {
    checkResult( getOpenOrderByUserId($conn) );
  }
}

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
  if ( isset($_POST["orderId"], $_POST["deliveryTimeId"]) && normalize_string($conn) && test_int($_POST["orderId"], $_POST["deliveryTimeId"]) )
  {
    if ( isset($_POST["selectedMethodId"]) && !isset($_POST["paymentId"]) && test_int($_POST["selectedMethodId"]) )
    {

      // checkout next
      //var_dump("expression");
      processPayment($conn, $_POST["orderId"], $_POST["selectedMethodId"], $_POST["deliveryTimeId"], $paypal);
    }
  
    elseif ( isset($_POST["paymentMethodId"]) && normalize_string($conn, $_POST["paymentId"], $_POST["payerId"]) && test_int($_POST["paymentMethodId"]) )
    {
      chargeCustomer($_POST["paymentId"], $_POST["payerId"], $paypal, $_POST["orderId"], $_POST["deliveryTimeId"], $_POST["paymentMethodId"], $conn);
    }
    else {
      echo "error";
    }
  }
}

// if ($_SERVER['REQUEST_METHOD']=="PUT")
// {
//   //echo "most";
//   $data = json_decode(file_get_contents("php://input"));
//   chargeCustomer($data->paymentId,$data->payerId,$paypal,$data->categoryId,$conn);
//   //$data = json_decode(file_get_contents("php://input"));
  
// }

if ($_SERVER['REQUEST_METHOD'] == "DELETE")
{
  if ($_SESSION["roleId"] == 1)
  {
    if (isset($_GET["orderId"]) && test_int($_GET["orderId"]))
    {
      deleteOpenOrderById($conn,$_GET["orderId"]);
    }
  }
}

require('CafeteriaApp/CafeteriaApp/CafeteriaApp.Backend/footer.php');

?>