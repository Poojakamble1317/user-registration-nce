<?php
session_start();
ob_start();
if(
    // !empty($_GET['token']) && isset($_GET['token']) && 
// !empty($_GET['type']) && isset($_GET['type']) &&
!empty($_POST['firstname']) && isset($_POST['firstname']) &&
!empty($_POST['email']) && isset($_POST['email']) &&
!empty($_POST['phoneno']) && isset($_POST['phoneno']) &&
!empty($_POST['password']) && isset($_POST['password'])&&
!empty($_POST['conpassword']) && isset($_POST['conpassword'])&&
!empty($_FILES['userpicture']) && isset($_FILES['userpicture'])){
	require_once 'secureKey/secureKey.php';
	require_once('apps/cofig.inc.php');
	$db = new DBcon();
	$con = $db->ConnectionMysql();
	$firstname = mysqli_real_escape_string($con,filter_var($_POST['firstname'],FILTER_SANITIZE_STRING));
	$email = mysqli_real_escape_string($con,filter_var($_POST['email'],FILTER_SANITIZE_STRING));
	$phoneno = mysqli_real_escape_string($con,filter_var($_POST['phoneno'],FILTER_SANITIZE_STRING));
	$password = mysqli_real_escape_string($con,filter_var($_POST['password'],FILTER_SANITIZE_STRING));
    $conpassword = mysqli_real_escape_string($con,filter_var($_POST['conpassword'],FILTER_SANITIZE_STRING));
    if($password == $conpassword){
	    $new_password = hash("sha512",md5(sha1($password)));
    }
    $allowed_files = array("jpg","JPG","jpeg","JPEG","PNG","png","gif","GIF");
    $maximum_file_size = 1024*10000;
    $upimagesize = filesize($_FILES['userpicture']['tmp_name']);
    $file_name = $_FILES['userpicture']['name'];	
    $imageFileType = pathinfo($file_name,PATHINFO_EXTENSION);  
    $path = "../images/";
    if($upimagesize > $maximum_file_size){
        $_SESSION['save_user']= "badSize";
        echo "badSize";
        // header('location:index.php');
    }else{
        if(in_array($imageFileType,$allowed_files)){
            if(move_uploaded_file($_FILES['userpicture']['tmp_name'],$path.$file_name)){
                $insertQry =$con->query("INSERT INTO `user` (`name`, `phoneno`, `email`, `password`, `profilephoto`) VALUES ('".$firstname."', '".$phoneno."', '".$email."', '".$new_password."', '".$path.$file_name."')");
                if($insertQry){
                    $_SESSION['save_user'] = "good";
                    echo "good";
                    // header('location:../../create-user.php?token='.$_GET['token'].'&type='.$_GET['type']);
                }else{
                    $_SESSION['save_user'] = "bad";
                    echo "bad";
                    // header('location:../../create-user.php?token='.$_GET['token'].'&type='.$_GET['type']);
                }
            }else{
                $_SESSION['save_user'] = "badUpload";
                echo "badUpload";
                // header('location:../../create-user.php?token='.$_GET['token'].'&type='.$_GET['type']);
            }
        }else{
            $_SESSION['save_user'] = "badFile";
            echo "badFile";
            // header('location:../../create-user.php?token='.$_GET['token'].'&type='.$_GET['type']);
        }
    }	
}else{
    $_SESSION['save_user'] = "badSubmit";
    echo "badSubmit";
    // header('location:../../create-user.php?token='.$_GET['token'].'&type='.$_GET['type']);
}
ob_end_flush();
?>