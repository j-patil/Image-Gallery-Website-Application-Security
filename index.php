<!-- The code has been adapted and modified as per requirement by Jayesh Patil. Credits: https://www.youtube.com/watch?v=3EMMn9xogMc -->

<!-- The index page acts as the first page of interaction with this project. The username and password is 'admin', enter that and you can store your images now -->

<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<body>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel-heading">
					<center>
						<h3 class="panel-title">Enter your details</h3>
					</center>
				</div>
                    
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $myuser = $_POST['username'];
    $mypass= $_POST['password'];
    if ($myuser == '' || $mypass == '') {
        echo "<div class='alert alert-danger'>Enter username or password</div>";
}
else
{
include "connect.php";
$result = mysql_query("select * from tbl_login where username = '$myuser' and password='$mypass'");
if (mysql_num_rows($result)>0)
{
   $row = mysql_fetch_array($result);

   if ($row[3]=='admin')
	$_SESSION['uname']=$myuser;
    echo "<script>location.href='uploadphotos.php'</script>";
}
else
{
  echo "<div class='alert alert-danger'>Your username or password is incorrect</div>";
}
}
}
?>

					<form role="form" action="
						<?= $_SERVER['PHP_SELF'] ?>" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="username" type="username" autofocus>
								</div>
								<div class="form-group">
									<input class="form-control" placeholder="Password" name="password" type="password" value="">
									</div>
									<input type="submit" class="btn btn-lg btn-success btn-block" name="login" value="Login">
									</fieldset>
								</form>
							</center>
						</div>
					</div>
					<div align="center">
					</body>
				</html>