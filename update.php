<?php

include "connect.php";

if (isset($_REQUEST['update'])) 
{
    $user_id = $_GET['id'];
    $parent_id = $_REQUEST["parent_id"];
    $title = $_REQUEST["title"];
    $description = $_REQUEST["description"];
    $status = $_REQUEST["status"];   

    $sql = "UPDATE `category` SET parent_id='$parent_id',title='$title',description='$description',status='$status' WHERE id='$user_id'";

    $result = mysqli_query($conn, $sql);
    // $result = $conn->query($sql); 

    if ($result == TRUE) 
    {
        echo "Record updated successfully.";

        header("location:view.php");
    } else {
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['id'])) {

    $user_id = $_GET['id'];

    $sql1 = "SELECT * FROM  `category`  WHERE `id`='$user_id'";
    // $result=mysqli_query($conn, $sql1);
    $result1 = $conn->query($sql1);

    if ($result1->num_rows > 0) {

        while ($row = $result1->fetch_assoc()) 
        {
            $parent_id = $row["parent_id"];
            $title = $row["title"];
            $description = $row["description"];
            $status = $row["status"];
        }



?>
        <h2 align="center">User Update Form</h2>

        <form method="POST">
          <table border="1" align="center" cellpadding="15" cellspacing="0">
            <tr>
                <th colspan="2"><h2>category_master</h2></th>
            </tr>
            <tr>
                <th>title</th>
                <td><input type="text" name="title" value="<?php echo "$title"; ?>">
            </tr>
             <?php 
            $sql = "SELECT * FROM `category` WHERE parent_id= 0 ";    
            $result=mysqli_query($conn, $sql);                    
            ?>
            <tr>
                <th>parent_category</th>
                <td><select name="parent_id">    
                        <option value="0">--select--</option>
                        <?php
                        if ($result->num_rows > 0) 
                        {
                          while ($row = $result->fetch_assoc())
                          { 
                        ?>
                             <option value="<?php echo $row['id']; ?>" <?php if ($parent_id == $row['id']) 
                                                          { 
                                                            echo "selected"; 
                                                          } 
                                                    ?>><?php echo $row['title']; ?></option>                   
                        <?php
                          }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>description</th>
                <td><input type="text" name="description" value="<?php echo "$description"; ?>"></td>
            </tr>
            <tr>
                <th>status</th>
                 <td><input type="radio" name="status" value="Active"<?php if ($status == 'Active') {
                                                                                echo "checked";} ?>>Active
                <input type="radio" name="status" value="Deactive"<?php if ($status == 'Deactive') {
                                                                                echo "checked";} ?>>Deactive</td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="update" name="update">
                <input type="reset" name="clear" value="clear"></td>
            </tr>
          </table>
        </form>

        </body>

        </html>

<?php

    } else {
    }
}

?>
