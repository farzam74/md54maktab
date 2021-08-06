<?php

  require_once 'funcs.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body class="bg-light">
    <div class="d-flex justify-content-around" style="background-color: #e3f2fd;">
        <a href="signup.php" class="nav-link">Sign up</a>
        <a href="" class="nav-link">Sign in</a>
    </div>
    <div class="container">
        <div class="d-flex justify-content-center mt-5">
          <div class="w-25">
            <form action="signin.back.php" method="POST" >

                <div class="form-group">
                    <label>User name</label>
                    <input type="text" class="form-control" name="username" required>
                </div>

                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" name="password" required>

                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary px-5 mt-2 ">Sign in</button>
                </div>

                
              </form>
              
              <?php
                     echo "<span class='text-danger'>".session_return('error')."</span>";  //return error of sign in if exists
              ?>
              
           </div>


        </div>
    </div>
</body>
</html>