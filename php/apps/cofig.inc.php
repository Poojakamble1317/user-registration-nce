<?php
class DBcon{
	static $conreturn;
	public function ConnectionMysql(){
		$con = mysqli_connect('localhost','root','','user_registration');
		if($con){
			$conreturn = $con;
		}else{
			$conreturn = mysqli_error($con);
		}
		return $conreturn;
	}
}

?>