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
		       </head>
	 <body  class="container">
<?php
include 'DBConn.php';
  $item = $_GET['item'];
  
      $selectItemsSql = "SELECT `Description`,`SellPrice` FROM `tbl_item` WHERE `itemID` = '".$item."'";
    $result = mysqli_query($connect, $selectItemsSql);

    if (mysqli_num_rows($result) > 0) {
	echo "<table width='50%' border='1' class='table' width='10%'>\n";
        while ($row = mysqli_fetch_array($result)) {
			
			echo "<tr><td style='width: 40%'>".$row['Description']."</td><td style='width: 40%'>".$row['SellPrice']."</td></tr>";
        }	
		echo "</table>\n";
		
    } else {
        echo "No Items found";
    }
    mysqli_close($connect);
?>
	 </body>
</html>