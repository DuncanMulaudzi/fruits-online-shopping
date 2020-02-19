<html>
 <head>
 		    <link rel="stylesheet" href="../POE_Task1/css/bootstrap.min.css">
			<link rel="stylesheet" href="../POE_Task1/css/styling.css">
			<script src="../POE_Task1/js/jquery.min.js"></script>
			<script src="../POE_Task1/js/bootstrap.min.js"></script>
 </head>
 <body>
 <div id="body" class="container">
 <h2>Connect to MySQL and create Users and Items</h2>
 <?php

include 'DBConn.php';

echo "------------------------------------------------ <br>";
echo "Creating Users <br>";
echo "------------------------------------------------ <br>";
#Create Users
$deleteTableSql = "DROP TABLE IF EXISTS `tbl_user`";
$createTableSql = "CREATE TABLE IF NOT EXISTS `tbl_user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FName` text NOT NULL,
  `Lname` text NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

#read the content of the txt file
$file_content = file("userData.txt");
#delete the table if exists
mysqli_query($connect, $deleteTableSql);
#create the table
mysqli_query($connect, $createTableSql);
#insert records from the txt file using a foreach loop
foreach ($file_content as &$line) {
    $line = explode(" ", $line);
    $createUserSql = "INSERT INTO `tbl_user` (`FName`, `Lname`, `Email`, `Password`) VALUES ('" .
        $line[0] . "', '" . $line[1] . "', '" . $line[2] . "', MD5('" . $line[3] . "'))";
    if (mysqli_query($connect, $createUserSql)) {
        echo "User (" . $line[0] . " " . $line[1] . ") is registered" . "<br>";
    } else {
        echo "User registration failed  <br>";
    }
}
echo "------------------------------------------------ <br>";
echo "Creating Items <br>";
echo "------------------------------------------------ <br>";
#Create Items
$deleteTableSql = "DROP TABLE IF EXISTS `tbl_item`";
$createTableSql = "CREATE TABLE IF NOT EXISTS `tbl_item` (
  `itemID` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `CostPrice` decimal(15,2) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `SellPrice` decimal(15,2) NOT NULL,
  PRIMARY KEY (`itemID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

#read the content of the txt file
$file_content = file("item.txt");
#delete the table if exists
mysqli_query($connect, $deleteTableSql);
#create the table
mysqli_query($connect, $createTableSql);
#insert records from the txt file using a foreach loop
foreach ($file_content as &$line) {
    $line = explode(" ", $line);
    $createItemSql = "INSERT INTO `tbl_item`(`itemID`, `Description`, `CostPrice`, `Quantity`, `SellPrice`) VALUES ('" .
        $line[0] . "','" . $line[1] . "','" . $line[2] . "','" . $line[3] . "','" . $line[4] .
        "')";
    if (mysqli_query($connect, $createItemSql)) {
        echo "Item (" . $line[1] . " ) is created" . "<br>";
    } else {
        echo "Failed to create  Item [" . $line[0] . "] <br>";
    }
}

mysqli_close($connect);
?>
 </div>	
 </body>
</html>