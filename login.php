<?php
    ob_start();
    session_start();
    require_once 'php/secureKey/secureKey.php';
    $options = array();
    $options['disable_flash_fallback'] = false;
    $nsel = usersecure::userencrypt('NULL');
    $thelogin = usersecure::userencrypt(date('dmy').'macartloginpage');
    require_once('php/apps/cofig.inc.php');
    $db = new DBcon();
    $con = $db->ConnectionMysql();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Login Form</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" crossorigin="anonymous">
  </head>
  <body>
    <div class="login-con container">
      <div class="mb-3"><h3>Login</h3></div>
      <form action="<?=_USER_REGISTER_URL_?>/php/login-auth.php?authid=<?=$thelogin?>" method="post">
        <?php if(isset($_SESSION['loginDetails'])){?>
            <div class="control-group"><?=$_SESSION['loginDetails']?></div>
        <?php unset($_SESSION['loginDetails']);
                } 
        ?>
        <div class="form-group input-group-sm mb-2">
          <label for="Email1">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" required aria-describedby="emailHelp" name="email">
        </div>
        <div class="form-group input-group-sm mb-2">
          <label for="Password">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword" name="password" required>
        </div>
        <div class="form-group mb-2 text-center">
            <label for="resetPassword"><a href="">Forgot Password</a></label>
        </div>
        <div class="d-grid gap-2 mb-2">
          <button type="submit" class="btn btn-secondary" name="create">Singin</button>
        </div>
      </form>
      <div class="form-group text-center">
            <label for="NewRegister"><a href="">Register Now</a></label>
        </div>
    </div>
  </body>
</html>