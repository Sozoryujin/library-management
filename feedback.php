<?php
include("thanks.html");
$fed=$_POST['feedback'];
$e=$_POST['email'];
$servername = "localhost:3308";
   $username = "root";
    $password = "";
    $dbname = "awd_project";
    $conn = new mysqli($servername, $username, $password, $dbname);
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            };
            $sql="INSERT INTO users_feedback (Email,Feedback) VALUES ('$e','$fed')";
            $result=$conn->query($sql); 
            ?>
        