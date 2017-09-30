<?php

$mykey1=$_REQUEST['key1'];

//a delete query performing delete operation on SQL

include 'connect.php';
mysql_query("delete from tbl_images where id = $mykey1");
echo "<script>location.href='viewphotos.php'</script>"

?> 