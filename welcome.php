<?php session_start();?>

<!DOCTYPE html>
<html>
     <head>
	      <title>Login Page</title>
		    <link rel="stylesheet" href="../POE_Task1/css/bootstrap.min.css">
			<link rel="stylesheet" href="../POE_Task1/css/styling.css">
			<script src="../POE_Task1/js/jquery.min.js"></script>
			<script src="../POE_Task1/js/bootstrap.min.js"></script>
		  <style>
   
		  </style>
		  
		  <script language="JavaScript" type="text/javascript"> 

  function popUp(url, win) 
  { 
  var ptr = window.open(url, win,'width=520,height=90,top=100,left=1300');
  return false;
  }
  </script>
  
     </head>
	 <body  class="container">
	    <div id="form" class="form-group">
		   <h2 style="text-align:center;">Welcome</h2><hr>
		   <h2 style="text-align:center;">fruits and vegetables supermarket</h2>
		   <h6><?php	
		   echo "User <b>" .$_SESSION["name"]. " " .$_SESSION["lname"]. "</b> is logged in"		  		   
		   ?>
		   
		   </h6>
	      <form method="post" action="#">
		        <table class="table" width='10%'>
					  <tr>
					     <td></td>
					     <td><input type="submit"  value="Show Items" name="submit" class="btn btn-primary"></td>
				     </tr>				 
		        </table>
	      </form>
		  </div>
		  <div class="form-group">
		  <?php
include 'DBConn.php';

if (isset($_POST['submit'])) {

    $selectItemsSql = "SELECT `itemID`, `Description`FROM `tbl_item`";
    $result = mysqli_query($connect, $selectItemsSql);

    if (mysqli_num_rows($result) > 0) {
	echo "<table width='50%' border='1' class='table' width='10%'>\n";
        while ($row = mysqli_fetch_array($result)) {
			
			echo "<tr><td style='width: 40%'>".$row['Description']."</td><td  style='width: 40%'><img src=images/".$row['itemID'].".jpeg alt=".$row['itemID']." width='100' height='80'></td><td  style='width: 20%'><a href='price.php?item=".$row['itemID']."' onclick='return popUp(this.href, this.target);'><img src=icon/shopping_cart.png width='50' height='40'></a></td></tr>";
        }
		
		echo "</table>\n";
		
    } else {
        echo "No Items found";
    }
    mysqli_close($connect);
}
?>
		  </div>
	 </body>
</html>