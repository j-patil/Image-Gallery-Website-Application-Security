<!-- This php file enables user to change captions of an image -->

<!-- Maintaining session -->
<?php session_start();
if(isset($_SESSION['uname']))
{
?>

<?php include "headers.php"; ?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Edit Caption</h1>
		</div>
	</div>

<?php
include"connect.php";
$mykey2=$_REQUEST['key2'];
 
if(isset($_POST['caption'])) {
        $newcaption = $_POST['caption'];
        $error=array();
    
        //update query to modify caption
        mysql_query("UPDATE tbl_images SET caption='$newcaption' where id = $mykey2;");
    
    if(empty($error)){
    echo " <div class='alert alert-success'>Caption is edited, Go check it out. :) 
		<a href='viewphotos.php'>View Photos</a> |
		<a href='addevent.php'> Add new Photos</a>
	</div>";
    }
}
?>
    <!-- html page for providing UI for updating caption -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-6">
							<form action="#" method="post" enctype="multipart/form-data" name="upload">
								<div class="form-group">New Caption: <input type="text" name="caption" id="capt"></div>
									<button type="submit" class="btn btn-primary" name="submit">Submit Button</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
    }
else
{
header("location:login.php");
}
?>
	</body>
</html>
