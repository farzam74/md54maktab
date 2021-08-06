<?php 
  include 'funcs.php';
  include 'teheri_gregorianToJalali.php';
  include 'set_get.php';

  session_start();
  unset($_SESSION['file-size']);
  unset($_SESSION['file-type']);

  unset_cookie('edit');
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

     <div class="container mt-5">

        <div class="d-flex justify-content-center">

            <h3 class="mx-3">Add Contact:</h3>
            <form action="" method="POST">
                <input type="text"  name="username" required> 
                <button type="submit" class="btn btn-primary px-2">Add by username</button>
            </form>

            <form action="" method="POST" class="mx-3">
                <input type="email"  name="email" class="px-5" required> 
                <button type="submit" class="btn btn-primary px-2">Add by email</button>
            </form>



        </div>

        <div class="d-flex justify-content-around mt-5 ">
          <ul>
              <?php
              

                  //addContact function is a function for add contacts by post index argument,if there isn't any error this would add contact with user 
                  // cookie index, else if there are errors, this function returns suitable errors.
                  addContact('email');  
                  addContact('username');
                
                  //create a list of contact:
                  if(jsonToArrTxt('contacts.txt') != null){

                      $username=$_COOKIE['username'];
                      $array=jsonToArrTxt('contacts.txt');

                      if(array_key_exists($username,$array)){ //check if index of user exist in contact.txt file this mean does user have any contact in contacts.txt file?.

                          foreach ($array[$username] ?? [] as $value) {
                              
                              echo "<li><a href='privatechat.php?newchat=".$value."' class='nav-link'> $value </a> </li>";

                          }
                      }


                  }

              ?>
         </ul>
       </div> 


     </div>
    
 







  </body>
</html>

