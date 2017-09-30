<!-- The code has been adapted and modified as per requirement by Jayesh Patil. Credits: https://www.youtube.com/watch?v=3EMMn9xogMc -->
<?php 
//for connecting to database
$con = mysql_connect("localhost","root","");

if (!$con)
{
  die();
}

mysql_select_db("db_photos",$con);
?>