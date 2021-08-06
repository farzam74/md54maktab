<?php
  require_once 'form-control.php';
  require_once 'funcs.php';

  session_start();
  unset($_SESSION['error']);
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
        <a href="" class="nav-link">Sign up</a>
        <a href="signin.php" class="nav-link">Sign in</a>
    </div>
    <div class="container">
        <div class="d-flex justify-content-center mt-5">
          <div class="w-25">
            <form action="" method="POST" >

                <div class="form-group">
                    <label>Full name</label>
                    <input type="text" class="form-control" name="fullname" required>

                    <?php
                    error_return('fullname',$name_func);
                    ?>

                </div>

                <div class="form-group">
                    <label>User name</label>
                    <input type="text" class="form-control" name="username" required>

                    <?php
                        error_return('username',$username_func);
                    ?>

                </div>

                <div class="form-group">
                    <label for="Email">Email address</label>
                    <input type="email" class="form-control" id="Email" name="email" required>

                    <?php
                        error_return('email',$email_func);
                    ?>

                </div>
                

                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" name="password" required>

                  <?php
                        error_return('password',$pass_func);
                    ?>

                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary px-5 mt-2 ">Submit</button>
                </div>

                
              </form>
              
              <?php

                //check validate of inputs
                if(post_return('fullname',$name_func)==1 && post_return('username',$username_func)==1 && post_return('email',$email_func)==1 && post_return('password',$pass_func)==1){
                    
                    $fullname=$_POST['fullname'];
                    $username=$_POST['username']; 
                    $password=$_POST['password'];     
                    $email=$_POST['email'];

                    $hashedPassword=md5($password);
                    $array=jsonToArrTxt('users.txt');
                    $nullArr=[];
                
                    if($array == null || ( getUserIndex($username,$array['users'],'username') === false && getUserIndex($username,$array['delusers'] ?? [],'username') === false)){ //if username has been never used before

                      if(getUserIndex($email,$array['users'] ?? [],'email') !== false || getUserIndex($email,$array['delusers'] ?? [],'email') !== false){ //if email has been used before

                        echo "<span class='text-danger'> This email has been used before,please try another email. </span>"; 
                       }

                       else{ 
                        
                        //add user to users array in users.txt file
                        $array['users'][]=[

                          'fullname' => $fullname,
                          'username' => $username,
                          'email' => $email,
                          'password' => $hashedPassword,
                          'date-type' => 'gregorian'

                        ];
                      
                        arrToJsonTxt($array,'users.txt');

                        echo "<span class='text-success'> You are successfully registered,if you want to redirect to your account please click <a href='signin.php'> Sign in <a/>. </span>"; 

                      }  
                      
                   }
                      
                 
                    else if(getUserIndex($username,$array['users'],'username') !== false || getUserIndex($username,$array['delusers'],'username') !== false ){  //if username has been used before

                    echo "<span class='text-danger'> This username has been used before,please try another username. </span>"; 

                  } 
              }
                ?>
           </div>


        </div>
    </div>
</body>
</html>