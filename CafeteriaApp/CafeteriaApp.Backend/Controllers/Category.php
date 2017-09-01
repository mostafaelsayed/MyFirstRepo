<?php

require_once('CafeteriaApp.Backend/ImageHandle.php');

function getByCafeteriaId($conn,$id)
{
  if (!isset($id))
  {
    //echo "Error: Id is not set";
    return;
  }
  else
  {
    $sql = "select * from category where CafeteriaId = ".$id;
    if ($result = $conn->query($sql))
    {
      $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
      mysqli_free_result($result);
        return $categories;
  
    }
    else
    {
      echo "Error Retrieving Categories: " . $conn->error;
    }
  }
}

function getCategoryById($conn,$id)
{
  if (!isset($id))
  {
    //echo "Error: Id is not set";
    return;
  }
  else
  {
    $sql = "select * from category where Id = ".$id." LIMIT 1";
    if ($result = $conn->query($sql))
    {
      $category = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
        return $category;
    }
    else
    {
      echo "Error Retrieving Category: " . $conn->error;
    }
  }
}

function addCategory($conn,$name,$cafeteriaId,$imageData = null)
{
  if (!isset($name) || !isset($cafeteriaId))
  {
    //echo "Error: Name is not set";
    return;
  }
  else
  {
    if ($imageData != null)
    {
      $imageFileName = addImageFile($imageData);
      $sql = "insert into category (Name,Image,CafeteriaId) values (?,?,?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssi",$Name,$Image,$Id);
      $Name = $name;
      $Id = $cafeteriaId;
      $Image = $imageFileName;
    }
    else
    {
      $sql = "insert into category (Name,CafeteriaId) values (?,?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("si",$Name,$Id);
      $Name = $name;
      $Id = $cafeteriaId;
    }

    if ($stmt->execute()===TRUE)
    {
      return "Category Added successfully";
    }
    else
    {
      echo "Error: ".$conn->error;
    }
  }
}

function editCategory($conn,$name,$id,$imageData = null)
{
  if (!isset($name) || !isset($id))
  {
   // echo "Error: Name is not set";
    return;
  }
  else
  {
    $result = $conn->query("select Image from category where Id = ".$id);
    $category = (mysqli_fetch_assoc($result));
    mysqli_free_result($result);
    if ($imageData != null && $imageData != $category['Image'])
    {
      $imageFileName = editImage($imageData,$category['Image']);
      $sql = "update category set Name = (?) , Image = (?) where Id = (?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssi",$Name,$Image,$Id);
      $Name = $name;
      $Id = $id;
      $Image = $imageFileName;
    }
    else
    {
      $sql = "update category set Name = (?) where Id = (?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("si",$Name,$Id);
      $Name = $name;
      $Id = $id;
    }

    if ($stmt->execute()===TRUE)
    {
      return "Category updated successfully";
    }
    else
    {
      echo "Error: ".$conn->error;
    }
   
  }
}

function deleteCategory($conn,$id)
{
  if (!isset($id))
  {
    //echo "Error: Id is not set";
    return;
  }
  else
  {
    $sql = "select Image from category where Id = ".$id." LIMIT 1";
    $result = $conn->query($sql);
    deleteImageFileIfExists(mysqli_fetch_assoc($result)['Image']);
    mysqli_free_result($result);
    //$conn->query("set foreign_key_checks=0");
    $sql = "delete from category where Id = ".$id." LIMIT 1";
    if ($conn->query($sql)===TRUE)
    {
      return "Category deleted successfully";
    }
    else
    {
      echo "Error: ".$conn->error;
    }
  }
}

?>