<?php 
require_once("CafeteriaApp.Backend/session.php");// must be first as it uses cookies

function getCustomers($conn,$backend=false)
{
  $sql = "select * from Customer";
  $result = $conn->query($sql);
  if ($result)
  {
    $result = $conn->query($sql);
    $customers = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    if ($backend)
    {
      return $customers;
    }
    else
    {
    $customers = json_encode($customers);

      echo $customers;
    }
  }
  else
  {
    echo "Error retrieving customers: " . $conn->error;
  }
}

function getCustomerById($conn ,$id,$backend=false)
{
  if (!isset($id))
  {
    echo "Error: Customer Id is not set";
    return;
  }
  else
  {
    $sql = "select * from Customer where Id =".$id." LIMIT 1";
    $result = $conn->query($sql);
    if ($result) {
      $customers = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      if ($backend)
      {
        return $customers;
      }
      else
      {
      $customers = json_encode($customers);

        echo $customers;
      }
    }
    else
    {
      echo "Error retrieving Customer: " . $conn->error;
    }
  }
}

function getCurrentCustomerinfoByUserId($conn,$backend=false)
{
  if (isset($_SESSION["UserId"]))
  {
    $userId=$_SESSION["UserId"];
  }
  if (!isset($userId))
  {
    echo "Error: User Id is not set";
    return;
  }
  else
  {
    $sql = "select * from Customer inner join User on Customer.UserId=User.Id  where Customer.UserId =".$userId." LIMIT 1";
    $result = $conn->query($sql);
    if ($result)
    {
      $customer = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      if ($backend)
      {
        return $customer;
      }
      else
      {
      $customer = json_encode($customer);

        echo $customer;
      }
    }
    else
    {
      echo "Error retrieving customer: " . $conn->error;
    }
  }
}

function getCustomerByUserId($conn,$userId,$backend=false)
{
  if (!isset($userId))
  {
    echo "Error: User Id is not set";
    return;
  }
  else
  {
    $sql = "select * from Customer where UserId =".$userId." LIMIT 1";
    $result = $conn->query($sql);
    if ($result)
    {
      $customer = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      if ($backend)
      {
        return $customer;
      }
      else
      {
        $customer = json_encode($customer);

        echo $customer;
      }
    }
    else
    {
      echo "Error retrieving customer: " . $conn->error;
    }
  }
}

function getCustomerIdByUserId($conn,$userId,$backend=false)
{
  if (!isset($userId))
  {
    echo "Error: User Id is not set";
    return;
  }
  else
  {
    $sql = "select Id from Customer where UserId =".$userId." LIMIT 1";
    $result = $conn->query($sql);
    if ($result)
    {
      $customer = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      if ($backend)
      {
        return $customer;
      }
      else
      {
      $customer = json_encode($customer);

        echo $customer;
      }
    }
    else
    {
      echo "Error retrieving customer: " . $conn->error;
    }
  }
}



function addCustomer($conn,$cred,$dob,$userId,$genderId) {
   if( !isset($cred))
 {
 echo "Error: Credit is not set";
  return;
  }
elseif (!isset($userId)) {
 echo "Error: User Id is not set";
  return;
  }
  else {
  $sql = "insert into Customer (Credit,DateOfBirth,UserId,GenderId) values (?,?,?,?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("dsii",$Credit,$Dob,$UserId,$GenderId);
  $Credit = $cred;
  $Dob=$dob;
  $UserId=$userId;
  $GenderId=$genderId;
  //$conn->query($sql);
  if ($stmt->execute()===TRUE) {
    return true;
  }
  else {
    return false;
  }
}}


function editCustomerCredit($conn,$cred,$userId) {
  if( !isset($cred))
 {
 echo "Error: Credit is not set";
  return;
  }
elseif (!isset($userId)) {
 echo "Error: User Id is not set";
  return;
  }
  else {
  $sql = "update Customer set Credit = Credit+(?) where UserId = (?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("fi",$Credit,$UserId);
  $Credit = $cred;
  $UserId = $userId;
  //$conn->query($sql);
  if ($stmt->execute()===TRUE) {
    echo "Customer Credit updated successfully";
  }
  else {
    echo "Error: ".$conn->error;
  }
}}




?>
