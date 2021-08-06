<?php 
  include 'funcs.php';
  include 'teheri_gregorianToJalali.php';
  include 'set_get.php';

  session_start();  
  unset($_SESSION['file-size']);
  unset($_SESSION['file-type']);

  unset_cookie('edit');


  //calculate online users:
  $array=jsonToArrTxt('onlineusers.txt');

  if (!isset($_SESSION['loaded'])){

    $_SESSION['loaded']=true;
    if ($array==null) $array=[];  

    //take unique username cookies into a file:
    if(count($array)==0) {  

      if(isset($_COOKIE['username']))  array_push($array,$_COOKIE['username']);

        arrToJsonTxt($array,'onlineusers.txt');

    }

    $flag=true;

    if(count($array)>0){ 
      //check for don't add users who closed their browser before and join again:
      if(isset($_COOKIE['username'])) {

            foreach ($array as $value) {

                  if($value==$_COOKIE['username']) $flag=false;

            }

            if ($flag==true) array_push($array,$_COOKIE['username']);

            arrToJsonTxt($array,'onlineusers.txt');

      }      
    }
  }


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
     <div class="d-flex justify-content-between container mt-5">
       <div>
        <?php
        
          $array=jsonToArrTxt('chats.txt');
          $userArray=jsonToArrTxt('users.txt');
          $user=$_COOKIE['username'];

          date_default_timezone_set('Iran');

          $index=getUserIndex($user,$userArray['users'],'username'); //get index of user in users.txt file
          $dateType=$userArray['users'][$index]['date-type'];

          
          if ($array==null) $array=[];
          $arrCounter=count($array);

          $counter=1; //show index of last  100 messages
            if($arrCounter<100){  //if  count of messages are less than or equal to 100 use this
              for($i=0; $i<$arrCounter ; $i++){

                $sender=$array[$i]['sender'];
                $timestamp=$array[$i]['timestamp'];
                $message=$array[$i]['message'];
                

                  echo "<span class='text-muted p-2'>".$counter."-".(($dateType=='jalali') ? convertGregorianToJalali(date("Y/m/d",$timestamp)) : date("Y/m/d",$timestamp))." | ".date("h:i:s",$timestamp)."::".$sender."</span> : ";
  
                  $bgWarning="<span class='bg-warning ml-5 border rounded p-1'>".$message."</span> <br> <br>";
                  $bgInfo="<span class='bg-info border rounded p-1'>".$message."</span> <br> <br>";
                    
                  //this used for determine background color of message,if the sender of message is user, background of message will be yellow else that will be green.
                  $finalMessage=($sender == $_COOKIE['username']) ? $bgWarning : $bgInfo; 
                
                  echo $finalMessage.'<br>';

                  $counter++; 
              }

              
            }
              else{   //if  count of messages are more than 100 use this
                for($j=(count($array)-100) ; $j<count($array) ; $j++){

                  $value=array_keys($array)[$j];

                  $sender=$array[$j]['sender'];
                  $timestamp=$array[$j]['timestamp'];
                  $message=$array[$j]['message'];
                  
  
                    echo "<span class='text-muted p-2'>".$counter."-".(($dateType=='jalali') ? convertGregorianToJalali(date("Y/m/d",$timestamp)) : date("Y/m/d",$timestamp))." | ".date("h:i:s",$timestamp)."::".$sender."</span> : ";
    
                    $bgWarning="<span class='bg-warning ml-5 border rounded p-1'>".$message."</span> <br> <br>";
                    $bgInfo="<span class='bg-info border rounded p-1'>".$message."</span> <br> <br>";
    
                    $finalMessage=($sender == $_COOKIE['username']) ? $bgWarning : $bgInfo; 
                  
                    echo $finalMessage.'<br>';

                    $counter++;
              }

 
            }
              
                
            ?>

           <div class="text-danger">

              <?php  echo cookie_return('charLimit');  ?>
             
           </div>

        <form action="publichat.back.php" method="post" id="form">
              <textarea name="message" id="" cols="60" rows="5" placeholder="type something..." required></textarea>
              <br>
              <input type="submit" name="submit" value="send" class="btn btn-primary">
          </form>
        </div>

          <div class="bg-info p-4 border rounded">

              <?php

                  //this part is for show online users:
                  $array=jsonToArrTxt('onlineusers.txt');

                  if($array==null) $array=[];

                  echo "online users: ".count($array);
                  echo "<br>";
                  echo "<br>";

                  foreach ($array as $value) {

                    echo "<a href='privatechat.php?newchat=".$value."' class='nav-link'> $value </a><br>";
                    
                  }
              ?>
          </div>



     </div>

    
 







  </body>
</html>

