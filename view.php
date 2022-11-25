<!-- //search mate
// How to make Search box & filter data in HTML Table from Database in PHP MySQL | PHP Tutorials - 15
 -->

<?php
include("connect.php");
$sql = "SELECT COUNT(*) As total_records FROM `category`";

    if (isset($_GET['page_no']) && $_GET['page_no']!="") 
      {
        $page_no = $_GET['page_no'];
      } 
      else 
      {
        $page_no = 1;
      }
        $total_records_per_page = 25;
        $offset = ($page_no-1) * $total_records_per_page;
        $previous_page = $page_no - 1;
        $next_page = $page_no + 1;
       // $adjacents = "2";
        $result_count = mysqli_query($conn,"SELECT COUNT(*) As total_records FROM `category`");
        $total_records = mysqli_fetch_array($result_count);
        $total_records = $total_records['total_records'];
        $total_no_of_pages = ceil($total_records / $total_records_per_page);
        $second_last = $total_no_of_pages - 1;

        $resume =mysqli_query($conn,"SELECT * FROM `category` LIMIT $offset, $total_records_per_page");

        $result = mysqli_query($conn,"SELECT category.id, category.title, category.description, category.status, category.parent_id, b.title as category_name FROM category LEFT JOIN category b ON (category.parent_id = b.id) ");
?>

<!DOCTYPE html>
<html>
<head>
  <title>View Page</title>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#search").focusout(function(){
    $('#search_btn').trigger('click');
   // alert('click');
  });
});
</script>

</head>
<body>
  <div class="container">
    <h2>category</h2>
  
  <div class="body">
    <form method="get">

      <div class="form-group" align="right">
         <input type ="text" name= "search" id="search" placeholder="Search..."/>
         <input type ="submit" name= "search_btn"  id="search_btn" class="btn-default" value="search"/>
      </div>
    
    </form>
    <?php
       if(isset($_GET['search_btn']))
       {
         $search_var = $_GET['search'];
         $sql = "SELECT * FROM category WHERE CONCAT(`description`,`title`,`status`) like '%".$search_var."%' ";

         if($result=mysqli_query($conn, $sql))
         {
          ?>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>parent_category</th>
          <th>title</th>
          <th>description</th>
          <th>status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
              if ($result->num_rows > 0) 
             { 
               while ($row = $result->fetch_assoc()) 
                {
                 ?>
                  <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['parent_id']; ?></td>
                    <td><?php echo $row['title']; ?></td>    
                    <td><?php echo $row['description']; ?></td> 
                    <td><?php echo $row['status']; ?></td>

                    <td><a class="btn btn-info" href="update.php?id=<?php echo $row['id']; ?>">Edit</a>&nbsp;
                      <a class="btn btn-danger" href="delete.php?id=<?php echo  $row['id']; ?>">Delete</a>
                    </td>
                  </tr>
                  <?php
                }
              }
          }
        }
                    ?>

      </tbody>
    </table>
  </div>
  </form>
    <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
    <strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
    </div>
    <ul class="pagination">

      <!--   <?php if($page_no > 1){
//      echo "<li><a href='?page_no=1'>First Page</a></li>";
      } ?> -->
          
      <li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
          <a <?php if($page_no > 1){
          echo "href='?page_no=$previous_page'";
          } ?>>Previous</a>
      </li>

      <?php
         if ($total_no_of_pages <= 10)
          {     
            for ($counter = 1; $counter <= $total_no_of_pages; $counter++)
             {
                if ($counter == $page_no) 
                  {
                   echo "<li class='active'><a>$counter</a></li>"; 
                  }
                  else
                  {
                    echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                  }
              }
          }
      ?>
      <li <?php if($page_no >= $total_no_of_pages)
                {
                  echo "class='disabled'";
                } ?>>
      <a <?php if($page_no < $total_no_of_pages) {echo "href='?page_no=$next_page'";} ?>>Next</a>
      </li>

      <!-- <?php if($page_no < $total_no_of_pages){
 //     echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
      } ?> -->
    </ul>

  </div>
</body>

</html>
