<?php
  include("connect.php");
  
  if(isset($_REQUEST["submit"]))
  {
    $title = $_REQUEST["title"];
    $category = $_REQUEST["category"];
    $description = $_REQUEST["description"];
    $status = $_REQUEST["status"];


    $query ="INSERT INTO `category` VALUES ('','$category','$title', '$description', '$status')"; 
   
    $result=mysqli_query($conn, $query);
       
       if($result)
       {
        echo "<h3> Data inserted into Database successfully </h3>";
       }
       else
       {
        echo "<h4> failed in database </h4>";
        //echo "Error:". $query . "<br>". $conn->error;
       }
  }
?>
