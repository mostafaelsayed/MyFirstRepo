<?php
  function getFeedbackAbouts($conn) {
    $sql = "select * from feedbackabouts";
    $result = $conn->query($sql);
    
    if ($result) {
      $feedbackAbouts = mysqli_fetch_all($result, MYSQLI_ASSOC);
      mysqli_free_result($result);

      return $feedbackAbouts;
    }
    else {
      echo "Error retrieving Feedback Abouts: ", $conn->error;
    }
  }

  function addFeedbackAbouts($conn, $name) {
    $sql = "insert into feedbackabouts (Name) values (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);

    if ($stmt->execute() === TRUE) {
      return  mysqli_insert_id($conn);
      //return "Comment Added successfully";
    }
    else {
      echo "Error: ", $conn->error;
    }
  }
?>