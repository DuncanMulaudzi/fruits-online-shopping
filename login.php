<?php
include 'DBConn.php';

session_start();
$name = "";
$sname = "";
$email = "";
$password = "";
if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $sname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $selectUserSql = "SELECT `ID`, `FName`, `Lname`, `Email`, `Password` FROM `tbl_user` WHERE `FName` = '" .
        $name . "' AND `Lname` = '" . $sname . "' AND `Email` = '" . $email .
        "' AND `Password` = MD5('" . $password . "')";
    $result = mysqli_query($connect, $selectUserSql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {	
			$_SESSION["name"] = $row['FName'];
            $_SESSION["lname"] = $row['Lname'];
			
			header("Location: welcome.php");
        }
    } else {
        echo "User login failed";
    }
    mysqli_close($connect);
}
?>
<?php

if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $sname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $insertUserSql = "INSERT INTO `tbl_user` (`FName`, `Lname`, `Email`, `Password`) VALUES ('" .
        $name . "', '" . $sname . "', '" . $email . "', MD5('" . $password . "'))";
    if (mysqli_query($connect, $insertUserSql)) {

        echo "User " . $name . " " . $sname . " is registered";

    } else {
        echo "User registration failed";
    }
    mysqli_close($connect);
}
?>
<!DOCTYPE html>
<html>
     <head>
	      <title>Login Page</title>
		    <link rel="stylesheet" href="../POE_Task1/css/bootstrap.min.css">
			<link rel="stylesheet" href="../POE_Task1/css/styling.css">
			<script src="../POE_Task1/js/jquery.min.js"></script>
			<script src="../POE_Task1/js/bootstrap.min.js"></script>
     </head>
	 <body >
	    <div id="form" class="container">
		   <h2 style="text-align:center;">Welcome</h2><hr>
		   <h3 style="text-align:center;">fruits and vegetables supermarket</h3>
	      <form method="post" action="#">
		        <table class="table" width='10%'>
				<div class="form-group">
				     <tr >
					     <td><b>Name:</b></td>
					     <td><input type="text" name="name" class="form-control" value="<?php echo $name; ?>" autofocus required placeholder="Enter name"></td>
				     </tr>
					 </div>
					 <div class="form-group">
					 <tr >
					     <td style="width: 20%"><b>Surname:</b></td>
					     <td style="width: 20%"><input type="text" name="surname" class="form-control" value="<?php echo $sname; ?>" required placeholder="Enter surname"></td>
				     </tr>
					 </div>
					 <div class="form-group">
					  <tr>
					     <td><b>Email address:</b></td>
					     <td><input type="text" name="email" class="form-control" value="<?php echo $email; ?>" required placeholder="Enter email"></td>
				     </tr>
					 </div>
					 <div class="form-group">
					  <tr> 
					     <td><b>Password:</b></td>
					     <td><input type="password" name="password" class="form-control" type="password"  required placeholder="Enter password"></td>
				     </tr>
					 </div>
					 <div class="form-group">
					  <tr>
					     <td></td>
					     <td><input type="submit"  value="Login" name="submit" class="btn btn-primary"></td>
						  <td style="width: 10%"><input type="submit"  value="Register" name="register" class="btn btn-default"></td>
				     </tr>
					</div>					 
		        </table>
			
	      </form>
		  </div>
		  <div>
		  </div>
	 </body>
</html>