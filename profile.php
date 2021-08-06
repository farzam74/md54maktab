<?php 
  include 'funcs.php';
  include 'teheri_gregorianToJalali.php';
  include 'set_get.php';
  require_once 'form-control.php';

  session_start();
  unset($_SESSION['file-size']);
  unset($_SESSION['file-type']);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
  </head>

  <body class="bg-light">
    <div  class="d-flex justify-content-around"  style="background-color: #e3f2fd; " >
              <a href="publicchat.php" class="nav-link">Pucblic chat</a>
              <a href="privatechat.php" class="nav-link">Private chat</a>
              <a href="profile.php" class="nav-link">Profile</a>
              <a href="contacts.php" class="nav-link">Contacts</a>
              <a href="signout.php" class="nav-link">Sign out</a>
    </div>

     <div class="container mt-5 text-center">

        <h5>User profile:</h5>
        <?php

            //get user index in users.txt file and show details of him
            $array=jsonToArrTxt('users.txt');
            $username=$_COOKIE['username'];
            $index=getUserIndex($_COOKIE['username'],$array['users'],'username');
            
           echo  "<b>Username: </b>".$array['users'][$index]['username']."<br>";

           echo  "<b>Fullname: </b>".$array['users'][$index]['fullname']."<br>";

           echo  "<b>Email: </b>".$array['users'][$index]['email']."<br>";
          
        ?>

        <a href="profile.click.php?edit=true" class="btn btn-primary text-center mb-3">Edit</a>
        <br>

        <?php

            //show edit form when edit button is clicked
            if(isset($_COOKIE['edit'])){?>

                <form action="" method="post">
                  <input type="text" class="mb-2" name="fullname" placeholder="Edit fullname">
                  <br>
                  <?php 
                    error_return('fullname',$name_func);
                  ?>
                  <br>
                  <input type="password"  class="mb-2" name="password" placeholder="Edit password">
                  <br>
                  <?php 
                    error_return('password',$pass_func);
                  ?>
                  <br>
                  <input type="submit" class="btn btn-primary" value="Save">
                
                </form>

        <?php }

              //replace new fullname and password of user if inputs don't have errors
              if (post_return('fullname',$name_func) == 1 && post_return('password',$pass_func) == 1){

                $array=jsonToArrTxt('users.txt');
                $nullArr=[];
        
                $fullname=$_POST['fullname'];
                $password=$_POST['password'];
                $hashedPassword=md5($password);


                $index=getUserIndex($_COOKIE['username'],$array['users'],'username');

                $array['users'][$index]=[

                  'fullname' => $fullname,
                  'username' => $array['users'][$index]['username'],
                  'email' => $array['users'][$index]['email'],
                  'password' => $hashedPassword,
                  'date-type' => $array['users'][$index]['date-type']

                ];

                $replaceArr=$array['users'][$index];
                array_replace_recursive($array,$replaceArr);
                arrToJsonTxt($array,'users.txt');
                unset_cookie('edit');
                header("Location: profile.back.php");
                exit();

              
            }

            ?>

            <div class="my-4">  

              <form action="date-type.php" method="post">
              
                <div class="form-group">

                  <label for="date-type">Select date type: </label>

                  <select name="date-type" id="date-type">

                    <option value="gregorian">Gregorian</option>
                    <option value="jalali">Jalali</option>

                  </select>

                  <input type="submit"  class="btn btn-primary">

              </div>

              </form>

            </div>

            <?php

            echo "<a href='deleteaccount.php' class='btn btn-primary text-center mt-3'>Delete account </a>"; 
        ?>
          
          

    </div>



     </div>
    
 







  </body>
</html>

