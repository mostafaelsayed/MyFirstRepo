<?php

function getWords($conn,$backend=false)
{
  $sql = "select * from Words ";
  $result = $conn->query($sql);
  if ($result)
  {
    $words = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    
    if ($backend)
    { 
      return $words;   
    }
    else
    {$words = json_encode($words);
      echo $words;
    }  
  }
  else
  {
    echo "Error retrieving Words: " . $conn->error;
  }
}


function addWord($conn,$name)
{
  $sql = "insert into Words (Name) values (?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s",$Name);
  $Name = $name;
  if ($stmt->execute()===TRUE)
  {
    echo "Word Added successfully";
  }
  else
  {
    echo "Error: ".$conn->error;
  }
}

function editWord($conn,$name,$id)
{
  $sql = "update Words set Name = (?) , where Id = (?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si",$Name,$Id);
  $Name = $name;
  $Id = $id;
  if ($stmt->execute()===TRUE)
  {
    echo "Word updated successfully";
  }
  else
  {
    echo "Error: ".$conn->error;
  }
}

function deleteWord($conn,$id) // drop the colun also ???????
{
  if (!isset($id))
  {
    echo "Error: Id is not set";
    return;
  }
  else
  {
    //$conn->query("set foreign_key_checks = 0"); // ????????/
    $sql = "delete from Words where Id = ".$id . " LIMIT 1";
    if ($conn->query($sql)===TRUE)
    {
      echo "Word deleted successfully";
    }
    else
    {
      echo "Error: ".$conn->error;
    }
  }
}

?>
