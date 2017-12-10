<?php
require('CafeteriaApp/CafeteriaApp/CafeteriaApp.Backend/Controllers/Order.php');
require('CafeteriaApp/CafeteriaApp/CafeteriaApp.Backend/Controllers/MenuItem.php');

function getOrderItemsByOrderId($conn, $id) {
  if ( !isset($id) ) {
    //echo "Error: Order Id is not set";
    return;
  }
  else {
    $sql = "select MenuItem.Name, OrderItem.Quantity, OrderItem.TotalPrice, OrderItem.MenuItemId, OrderItem.Id, OrderItem.OrderId from OrderItem INNER JOIN MenuItem ON  OrderItem.MenuItemId = MenuItem.Id where OrderItem.OrderId = " . $id;
    $result = $conn->query($sql);
    if ($result) {
      $orderItems = mysqli_fetch_all($result, MYSQLI_ASSOC);
      mysqli_free_result($result);
      return $orderItems;
    }
    else {
      echo "Error retrieving OrderItems : ", $conn->error;
    }
  }
}

// function getOrderItemsByOpenOrderId($conn, $id) {
//   if ( !isset($id) ) {
//     //echo "Error: Order Id is not set";
//     return;
//   }
//   else {
//     $sql = "select  MenuItem.Name, MenuItem.Id as MenuItemId, OrderItem.Id, OrderItem.OrderId, OrderItem.TotalPrice, OrderItem.Quantity from OrderItem INNER JOIN MenuItem ON OrderItem.MenuItemId = MenuItem.Id where OrderItem.OrderId = " . $id;
//     $result = $conn->query($sql);
//     if ($result) {
//       $orderItems = mysqli_fetch_all($result, MYSQLI_ASSOC);
//       mysqli_free_result($result);
//       return $orderItems;
//     }
//     else {
//       echo "Error retrieving OrderItems : ", $conn->error;
//     }
//   }
// }

function getOrderItemById($conn, $id) {
  if ( !isset($id) ) {
    //echo "Error: OrderItem Id is not set";
    return;
  }
  else {
    $sql = "select * from `OrderItem` where `Id` = " . $id . " LIMIT 1";
    $result = $conn->query($sql);
    if ($result) {
      $orderItem = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $orderItem;
    }
    else {
      echo "Error retrieving OrderItem : ", $conn->error;
    }
  }
}

function getOrderItemTotalPriceById($conn, $id) {
  if( !isset($id) ) {
    //echo "Error:MenuItem Id is not set";
    return;
  }
  else {
    $sql = "select `TotalPrice` from `OrderItem` where `Id` = " . $id . " LIMIT 1";

    if ( $result = $conn->query($sql) ) {
      $OrderItem = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $OrderItem['TotalPrice'];
    }
    else {
      echo "Error retrieving Order Item: ", $conn->error;
    }
  }
}

function editOrderItemQuantity($conn, $quantity, $id, $increaseDecrease) {
  if ( !isset($quantity) ) {
    //echo "Error: OrderItem quantity is not set";
    return;
  }
  elseif ( !isset($id) ) {
    //echo "Error: OrderItem id is not set";
    return;
  }
  else {
    $MenuItemId = getOrderItemById($conn, $id)['MenuItemId'];
    $unitPrice = getMenuItemPriceById($conn, $MenuItemId);
    //$orderId = getOpenOrderByUserId($conn)['Id'];
    //$totalPrice = $unitPrice;
    $sql = "update `OrderItem` set `Quantity` = (?), `TotalPrice` = `TotalPrice` + (?) where `Id` = (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("idi", $quantity, $unitPrice, $id);

    if ($increaseDecrease === false) {
      $unitPrice = -$unitPrice;
    }

    if ($stmt->execute() === TRUE) {
      return "OrderItem updated successfully";
    }
    else {
      echo "Error: ", $conn->error;
    }
  }
}

function addOrderItem($conn, $orderId, $menuItemId, $quantity) {
  if ( !isset($menuItemId) ) {
    //echo "Error: OrderItem menuItemId is not set";
    return;
  }
  elseif ( !isset($quantity) ) {
    //echo "Error: OrderItem quantity is not set";
    return;
  }

  $unitPrice = getMenuItemPriceById($conn, $menuItemId);
  $totalPrice  =  $quantity * $unitPrice;

  if ($orderId == null) {
    $deliveryTimeId = getCurrentTimeId($conn);
    $deliveryDateId = getCurrentDateId($conn);

     // create order by default values
    $orderId = addOrder($conn, $deliveryDateId, $deliveryTimeId, 4, 1, $_SESSION['userId']);
  }

  // if ($orderId == null)
  // {
  //   return $orderId;
  // }
  // if ($orderId != null)
  // {
  //   $sql = "insert into OrderItem (OrderId,MenuItemId,Quantity,TotalPrice) values (?,?,?,?)";
  //   $stmt = $conn->prepare($sql);
  //   $stmt->bind_param("iiid",$OrderId,$MenuItemId,$Quantity,$Price);
  //   $OrderId = $orderId;
  //   $MenuItemId = $menuItemId;
  //   $Quantity = $quantity;
  //   $Price =$totalPrice ;
  //   if ($stmt->execute()===TRUE)
  //   {
  //     //echo "OrderItem Added successfully";
  //     return $orderId;
  //   }
  //   else
  //   {
  //     echo "Error: ".$conn->error;
  //   }
  // }
  
  //else
  //{
//  updateOrderTotalById($conn,$orderId,$totalPrice);
  $sql = "insert into `OrderItem` (OrderId, MenuItemId, Quantity, TotalPrice) values (?, ?, ?, ?)"; // add TotalPrice to total of the order
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("iiid", $orderId, $menuItemId, $quantity, $totalPrice);
  //$OrderId = $orderId;
  //$MenuItemId = $menuItemId;
  //$Quantity = $quantity;
  //$Price = $totalPrice;
  if ($stmt->execute() === TRUE) {
    //echo "OrderItem Added successfully";
    return $orderId;
  }
  else {
    echo "Error: ", $conn->error;
  }
  //}
}

function deleteOrderItem($conn, $id) { // remove TotalPrice to total of the order
  if ( !isset($id) ) {
    // echo "Error: Id is not set";
    return;
  }
  else {
    //$orderId = getOpenOrderByUserId($conn)['Id'];
    $totalPrice = getOrderItemTotalPriceById($conn, $id);
    updateOrderTotalById($conn, $_SESSION['orderId'], -$totalPrice);
    $sql = "delete from `OrderItem` where `Id` = " . $id . " LIMIT 1";
    if ($conn->query($sql) === TRUE) {
      echo "Order Item deleted successfully";
      //return $orderId;
    }
    else {
      echo "Error: ", $conn->error;
    }
  }
}

function deleteOrderItemsByMenuItemId($conn, $id) {// remove TotalPrice to total of the order
  if ( !isset($id) ) {
    // echo "Error: Id is not set";
    return;
  }
  else {
   // $orderId =json_decode(getOpenOrderByCustomerId($conn), true)["Id"];
    //$totalPrice=getOrderItemTotalPriceById($conn,$id);
    //updateOrderTotalById($conn,$orderId,-$totalPrice);
    $sql = "delete from `OrderItem` where `MenuItemId` = " . $id;
    if ($conn->query($sql) === TRUE) {
      return "Order Item deleted successfully";
    }
    else {
      echo "Error: ", $conn->error;
    }
  }
}

function editOrderItemTotalPrice($conn, $totalPrice, $id) {
  if ( !isset($totalPrice) ) {
    //echo "Error: OrderItem quantity is not set";
    return;
  }
  elseif ( !isset($id) ) {
    //echo "Error: OrderItem id is not set";
    return;
  }
  else {
    $sql = "update `OrderItem` set `TotalPrice` = (?) where `Id` = (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("di", $totalPrice, $id);
    //$TotalPrice = $totalPrice;
    //$Id = $id;

    if ($stmt->execute() === TRUE) {
      return "OrderItem updated successfully";
    }
    else {
      echo "Error: ", $conn->error;
    }
  }
}
?>