<?php
error_reporting(E_ALL);
ob_start();
session_start();
$ref = $_SERVER['HTTP_REFERER'];
// var_dump($_POST); echo $ref; exit;
// if($ref == 'http://erptesting.macerp.in/' || $ref == 'http://erptesting.macerp.in/index.php'){
	require_once 'secureKey/secureKey.php';
	// include_once 'libs/php/securimage/securimage.php';
	$redirectUrl ="../";
	$thelogin = usersecure::userencrypt(date('dmy').'macartloginpage');
	if($thelogin == $_GET['authid']){
		// // $securimage = new Securimage();
		// // if($securimage->check($_POST['macart_captcha']) == false){
		// 	$_SESSION['loginDetails']= '<div class="alert alert-danger">
        //                 <div class="main_input_box">
        //                     <span>Wrong Captcha!!</span>
        //                 </div>
        //             </div>';
		// 	header("location:index.php");
			
		    // }else{
			$upas = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
			// $logType = filter_var($_POST['login-type'],FILTER_SANITIZE_STRING);
			// if(preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$*%)(]{6,20}$/',$upas)){
				if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)===false){
					// $usertype = filter_var($_POST['login-type'],FILTER_SANITIZE_STRING);
					$usertype = usersecure::userdecrypt("userRegistration");
					require_once('apps/cofig.inc.php');
					$db = new DBcon();
					$con= $db->ConnectionMysql();
					$uname = filter_var($_POST['email'],FILTER_SANITIZE_STRING);
					$username = mysqli_real_escape_string($con, $uname);
					$password = hash("sha512",md5(sha1($upas)));	
                    echo "SELECT `id` FROM `user` WHERE `email`='".$username."' AND
                    `password`='".$password."'";		
					$Query = $con->query("SELECT `id` FROM `user` WHERE `email`='".$username."' AND
					 `password`='".$password."'");
					$count =$Query->num_rows;
					if($count==1){
						$controllerid = $Query->fetch_array();
						$_SESSION['user_session'] = usersecure::userencrypt($controllerid[0]);
						$usertype = usersecure::userencrypt("userRegistration");
						header('location:'.$redirectUrl.'index.php?token='.$_SESSION['user_session']);

					}else{
						$_SESSION['loginDetails']= '<div class="alert alert-danger">
									<div class="main_input_box">
										<span>Bad Username or Password!! 5</span>
									</div>
								</div>';
                        echo "1";
						// header("location:$redirectUrl");
					}
				}else{
					$_SESSION['loginDetails']= '<div class="alert alert-danger">
								<div class="main_input_box">
									<span>Bad Username or Password!! 4</span>
								</div>
							</div>';
                            echo "2";
					// header("location:$redirectUrl");
				}
			// }else{
			// 	$_SESSION['loginDetails']= '<div class="alert alert-danger">
			// 				<div class="main_input_box">
			// 					<span>Bad Username or Password!! 3</span>
			// 				</div>
			// 			</div>';
            //             echo "3";
			// 	// header("location:$redirectUrl");
			// }
		// }
	}else{
		$_SESSION['loginDetails']= '<div class="alert alert-danger">
					<div class="main_input_box">
						<span>Bad Username or Password!!</span>
					</div>
				</div>';
                echo "4";
		// header("location:$redirectUrl");
	}

ob_end_flush();
?>