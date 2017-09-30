<!-- The code has been adapted and modified as per requirement by Jayesh Patil. Credits: https://www.youtube.com/watch?v=3EMMn9xogMc -->
<!-- This page does the work of uploading images in the database -->

<!-- Starts session for admin login -->
<?php session_start();
if(isset($_SESSION['uname']))
{
?>

<!-- Header.php provides 'Add photos' and 'View photos' options -->
<?php include "headers.php"; ?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Upload images here</h1>
		</div>
	</div>
    
    <!-- Script checking the file extension, and making sure the image format is supported -->
	<script type="application/javascript">
        
    function img_up(){
    var fup = document.getElementById('upload');
    var fileName = fup.value;
    var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
    if(ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext== "PNG" ||  ext=="png" || ext=="gif"){
        return true;
    }
    else{
        alert("Image format not supported!");
        fup.focus();
        return false;
    }
}             
    </script>
	<?php

//Including this will connect to the database
include"connect.php";
$rd=rand();
 
//Code for inserting caption, if no caption is written following caption is stored
if(isset($_POST['caption'])) {
        $captionsent = $_POST['caption'];
    if ($captionsent=="")
    {$captionsent="No caption entered";}
}
    
if(isset($_FILES['files'])){
    $errors= array();
	foreach($_FILES['files']['tmp_name'] as $key => $tmp_name){
		$file_name = $key.$rd.$_FILES['files']['name'][$key];
		$file_size =$_FILES['files']['size'][$key];
		$file_tmp =$_FILES['files']['tmp_name'][$key];
		$file_type=$_FILES['files']['type'][$key];	
        
        //making sure the file size is within limit of 10 mb
        if($file_size > 10485760){
			$errors[]='File size must be less than 10 MB';
        }
        
        $query="INSERT into tbl_images(`id`,`imgname`,`imgtype`,`imgsize`,`caption`) VALUES('','$file_name','$file_type','$file_size','$captionsent'); ";
        $desired_dir="uploadphotos";
        
        if(empty($errors)==true){
            // Create directory if it does not exist
            if(is_dir($desired_dir)==false){
                mkdir("$desired_dir", 0700);		
            }
            if(is_dir("$desired_dir/".$file_name)==false){

//creating thumbnail size images for viewing purpose for the project
$type = exif_imagetype($tmp_name);

    switch ($type) { 
        case 1 : 
            $src = imageCreateFromGif($tmp_name); 
        break; 
        case 2 : 
            $src = imageCreateFromJpeg($tmp_name); 
        break; 
        case 3 : 
            $src = imageCreateFromPng($tmp_name); 
        break; }


list($width,$height)=getimagesize($tmp_name);


$newwidth=($width/$height)*150;
$newheight=150;
$tmp=imagecreatetruecolor($newwidth,$newheight);

imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
$rd=rand();

$filename = "thumbphotos/".$file_name;
imagejpeg($tmp,$filename,100);

imagedestroy($src);

move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
}
else{
    // rename the file if another one exist
    $new_dir="$desired_dir/".$file_name.time();
    rename($file_tmp,$new_dir) ;				
    }
mysql_query($query);			
}else
        {
                print_r($errors);
        }
    }
	if(empty($error)){
	echo " 
	<div class='alert alert-success'>Image is uploaded :) 
		<a href='viewphotos.php'>View Photos</a> |
		<a href='uploadphotos.php'> Add new Photos</a>
	</div>";
	
	}
}	
?>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-6">
                            <!-- form taking image and caption as input -->
							<form action="#" method="post" enctype="multipart/form-data" name="upload">
								<div class="form-group">
									<input type="file" name="files[]" multiple  id="upload" />
                                    Caption (optional):<input type="text" name="caption" id="capt">
									</div>
									<button type="submit" class="btn btn-primary" name="submit">Submit Button</button>
								</form>
							</div>
						</div>
					</div>
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
?></body></html>
