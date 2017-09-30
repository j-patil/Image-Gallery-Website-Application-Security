<!-- The code has been adapted and modified as per requirement by Jayesh Patil. Credits: https://www.youtube.com/watch?v=3EMMn9xogMc -->
<!-- the page is responsible for making the image gallery -->

<!-- Maintaining the session for the admin user -->
<?php session_start();
if(isset($_SESSION['uname']))
{
?>
<?php include "headers.php"; ?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="table-responsive table-bordered">
                    
<?php
//connecting to the database
include"connect.php";
if (isset($_GET["page"])) { $page = $_GET["page"]; } else { $page=1; };
$start_from = ($page-1) * 10;
$sql = "select * from tbl_images ORDER BY id ASC LIMIT $start_from, 10";
$rs_result = mysql_query ($sql,$con);
?>

<table class="table">
<thead>
    <tr>
        <td>Image Name</td>
        <td>Image</td>
        <td>Caption</td>
        <td colspan=2>Delete photo</td>
    </tr>
</thead>
<?php
while ($row = mysql_fetch_assoc($rs_result)) {
?>
<tbody>
<tr>
<td>
<?php echo $row["imgname"]; ?>
</td>
<td>
<img src="thumbphotos/
<?php echo $row["imgname"]; ?>"  width="100px"/>
</td>
<td>
<a href='changecaption.php?key2=
<?php echo $row["id"]; ?>'>
<?php echo $row["caption"]; ?>
</a>
<td>
<a href='deletephoto.php?key1=
    <?php echo $row["id"]; ?>'>Delete
</a>
</tr>
</tbody>
<?php
};
?>
</table>
<strong>Pages  </strong>
<?php
$sql = "SELECT COUNT(imgname) FROM tbl_images";
$rs_result = mysql_query($sql,$con);
$row = mysql_fetch_row($rs_result);
$total_records = $row[0];
$total_pages = ceil($total_records / 10);
for ($i=1; $i<=$total_pages; $i++) {
echo "<a href='viewphotos.php?page=".$i."' class='navigation_item selected_navigation_item'>".$i."</a> ";
};
?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /#wrapper -->
<!-- jQuery Version 1.11.0 -->
<script src="js/jquery-1.11.0.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="js/plugins/metisMenu/metisMenu.min.js"></script>
<!-- DataTables JavaScript -->
<script src="js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
<!-- Custom Theme JavaScript -->
<script src="js/sb-admin-2.js"></script>
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>
<?php
}
else
{
header("location:login.php");
}
?></body></html>
