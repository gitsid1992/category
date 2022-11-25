<!DOCTYPE html>
<html>
<head>
    <title>category</title>
</head>
    <body>
         <?php include ("connect.php"); ?>
        <form method="POST" action="insert.php">
          <table border="1" align="center" cellpadding="15" cellspacing="0">
            <tr>
                <th colspan="2"><h2>category_master</h2></th>
            </tr>
            <tr>
                <th>title</th>
                <td><input type="text" name="title">
            </tr>
             <?php 
            $sql = "SELECT * FROM `category` WHERE parent_id=0";    
            $result=mysqli_query($conn, $sql);                    
            ?>
            <tr>
                <th>parent_category</th>
                <td><select name="category">    
                        <option value="0">--select--</option>
                        <?php
                        if ($result->num_rows > 0) 
                        {
                          while ($row = $result->fetch_assoc())
                          { 
                        ?>
                            <option value="<?php echo $row['id']; ?>" > <?php echo $row['title']; ?></option> 
                    
                        <?php
                          }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>description</th>
                <td><input type="text" name="description"></td>
            </tr>
            <tr>
                <th>status</th>
                 <td><input type="radio" name="status" value="Active">Active
                <input type="radio" name="status" value="Deactive">Deactive</td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="submit">
                <input type="reset" name="clear" value="clear"></td>
            </tr>
          </table>
        </form>
    </body>
</html>
