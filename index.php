<!DOCTYPE html>
<html>
  <head>
    <title>Registration</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <div class="mb-4"><h3>Create An Account</h3></div>
      <form action="php/registration.php" method="post" id="registration-form" enctype="multipart/form-data">
        <div class="form-group input-group-sm mb-2">
          <label for="firstname">Full Name</label>
          <input type="text" class="form-control" id="exampleInputfirstname" name="firstname" required>
        </div>
        <div class="form-group input-group-sm mb-2">
          <label for="phoneno">Phone Number</label>
          <input type="text" class="form-control" id="exampleInputphoneno" maxlength="10" name="phoneno" required>
        </div>
        <div class="form-group input-group-sm mb-2">
          <label for="Email1">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" required aria-describedby="emailHelp" name="email">
        </div>
        <div class="form-group input-group-sm mb-2">
          <label for="Password">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword" name="password" required>
        </div>
        <div class="form-group input-group-sm mb-2">
          <label for="Password">Comfirm Password</label>
          <input type="password" class="form-control" id="exampleInputCPassword" name="conpassword" required>
        </div>
        <div class="form-group input-group-sm mb-3">
        <label for="Password">Profile Picture</label>
          <input type="file" class="form-control" accept="image/*" id="inputGroupFile01" name="userpicture" required>
        </div>
        <div class="d-grid gap-2 mx-auto mb-3">
          <button type="submit" class="btn btn-secondary" name="create">Register Now</button>
        </div>
      </form>
    </div>
  </body>
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
  <script src="js/functions.js"></script>
</html>