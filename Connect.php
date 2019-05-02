<?php
$link = mysqli_connect('127.0.0.1','root','','LTWEB');
 /*if(!$link) {
 	die("Connection failed : " . mysqli_error());
 }
 else echo "Success";*/
mysqli_query($link, "SET NAMES UTF8");
?>