<?php
#$myfile = fopen("userData.txt", "r") or die("Unable to open file!");
#while(!feof($myfile)) {
#	$myfile = "userData.txt";
#$content = file_get_contents($myfile);

#$arr = explode(" ", $content);

#  print_r($arr)."<br>";
#}
#fclose($myfile);


$file_content = file("userData.txt");

foreach($file_content as &$line){
    $line = explode(" ", $line);
	print_r($line);
}
?>