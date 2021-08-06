<?php 
  include 'funcs.php';
  include 'teheri_gregorianToJalali.php';
  include 'set_get.php';
  session_start();

  unset_cookie('edit');

  //set receiver cookie to determine receiver for display user chat page with that user via $_get array argument that get from contacts or online users in public chat or recent chats
  if(isset($_GET['newchat'])){

    $receiver=$_GET['newchat'];

    setcookie('receiver',$receiver);

    //to refresh page  
    header("Location: contacts.back.php");
    exit();

  }

  if(isset($_GET['previouschat'])){

    $receiver=$_GET['previouschat'];

    setcookie('receiver',$receiver);

    header("Location: contacts.back.php");
    exit();

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

        <a href="publicchat.php" class="nav-link">Public chat</a>
        <a href="privatechat.php" class="nav-link">Private chat</a>
        <a href="profile.php" class="nav-link">Profile</a>
        <a href="contacts.php" class="nav-link">Contacts</a>
        <a href="signout.php" class="nav-link">Sign out</a>

    </div>
     <div class="d-flex justify-content-around container mt-5">
       <div>
        <?php
        
          $array=jsonToArrTxt('pvchats.txt');
          $userArray=jsonToArrTxt('users.txt');

          date_default_timezone_set('Iran');

          $sender=$_COOKIE['username'];

          $index=getUserIndex($sender,$userArray['users'],'username'); //get user index in users.txt file
          $dateType=$userArray['users'][$index]['date-type'];

          if(isset($_COOKIE['receiver'])){
          $receiver=$_COOKIE['receiver'];

          echo "<h5> Chat with $receiver : </h5> <br> <br>";
          

          if ($array==null) $array=[];

          //filter messages that contains user as sender and $_COOKIE['receiver] as receiver of pvchats.txt file:
          $filteredArr=array_values(filterMessage($array,'sender',$sender,'receiver',$receiver)); 

          $arrCounter=count($filteredArr);
          $counter=1; //show index of last  100 messages


            if($arrCounter<100){  //if  count of messages are less than or equal to 100 use this
              for($i=0; $i<$arrCounter ; $i++){

                  $timestamp=$filteredArr[$i]['timestamp'];
                  $message=$filteredArr[$i]['message'];
                  $sender=$filteredArr[$i]['sender'];
                  $receiver=$filteredArr[$i]['receiver'];
                  
                  if(array_key_exists('image',$filteredArr[$i])){ //check if message contains image show that

                   //show date and time of image in a suitable format with date type that user determine in profile page
                    echo "<span class='text-muted p-2'>".$counter."-".(($dateType=='jalali') ? convertGregorianToJalali(date("Y/m/d",$timestamp)) : date("Y/m/d",$timestamp))." | ".date("h:i:s",$timestamp)."::".$sender."</span> : ";

                    //put a small size of image in <a> tag,when user clicked on that can show full size of image
                    echo "<a href=".$filteredArr[$i]['image']."><img src=".$filteredArr[$i]['image']." height='200px' width='200px' class='mb-3'> </img></a><br>";

                  }
                  
                  if(strlen($message)>0){

                  echo "<span class='text-muted p-2'>".$counter."-".(($dateType=='jalali') ? convertGregorianToJalali(date("Y/m/d",$timestamp)) : date("Y/m/d",$timestamp))." | ".date("h:i:s",$timestamp)."::".$sender."</span> : ";
  
                  $bgWarning="<span class='bg-warning ml-5 border rounded p-1'>".$message."</span> <br> <br>";
                  $bgInfo="<span class='bg-info border rounded p-1'>".$message."</span> <br> <br>";
  
                  //this used for determine background color of message,if the sender of message is user, background of message will be yellow else that will be green.
                  $finalMessage=($sender == $_COOKIE['username']) ? $bgWarning : $bgInfo; 
                
                  echo $finalMessage.'<br>';

                  }
  
                  $counter++; 
                               
   
                }
            }

            else {  //if  count of messages are more than or equal to 100 use this
              for($j=(count($array)-100) ; $j<count($array) ; $j++){

                $timestamp=$filteredArr[$j]['timestamp'];
                $message=$filteredArr[$j]['message'];
                $sender=$filteredArr[$j]['sender'];
                $receiver=$filteredArr[$j]['receiver'];

                if(array_key_exists('image',$filteredArr[$j])){

                  echo "<span class='text-muted p-2'>".$counter."-".(($dateType=='jalali') ? convertGregorianToJalali(date("Y/m/d",$timestamp)) : date("Y/m/d",$timestamp))." | ".date("h:i:s",$timestamp)."::".$sender."</span> : ";

                  echo "<a href=".$filteredArr[$j]['image']."><img src=".$filteredArr[$j]['image']." height='200px' width='200px' class='mb-3'> </img></a><br>";

                }
                
                if(strlen($message)>0){

                echo "<span class='text-muted p-2'>".$counter."-".(($dateType=='jalali') ? convertGregorianToJalali(date("Y/m/d",$timestamp)) : date("Y/m/d",$timestamp))." | ".date("h:i:s",$timestamp)."::".$sender."</span> : ";

                $bgWarning="<span class='bg-warning ml-5 border rounded p-1'>".$message."</span> <br> <br>";
                $bgInfo="<span class='bg-info border rounded p-1'>".$message."</span> <br> <br>";

                $finalMessage=($sender == $_COOKIE['username']) ? $bgWarning : $bgInfo;
                
                echo $finalMessage."<br>";

                }

                $counter++; 
              }

            }
          
          }
            ?>


        <form action="privatechat.back.php" method="post" id="form" enctype="multipart/form-data">
              <textarea name="message" id="" cols="60" rows="5" placeholder="type something..."></textarea>
              <input type="file" name="image">
              <br>
              <input type="submit" name="submit" value="send" class="btn btn-primary">
          </form>
          <?php     


//show error of file upload if exist

if(isset($_SESSION['file-size'])) echo "<span class='text-danger'>{$_SESSION['file-size']}</span>";

if(isset($_SESSION['file-type'])) echo "<span class='text-danger'>{$_SESSION['file-type']}</span>";

?>
        </div>

          <div class="bg-info p-4 border rounded">
              <?php


                  //this part is for show recent chats of user
                  $array=jsonToArrTxt('pvchats.txt');

                   //filter persons who user has chatted with them  in pvchats.txt file and return index of messsage arrays that contains user as sender or receiver in them
                  $filteredperson=filterPersons($array ?? [],'sender','receiver',$sender);
                  $persons=[];
                  

                  echo "Recent chats:";
                  echo "<br>";
                  echo "<br>";
                  
                  foreach ($filteredperson as $value) {
                    $persons[]= ($value['sender']==$_COOKIE['username']) ? $value['receiver'] : $value['sender'];  //get receiver name if user is sender and get sender name if receiver is user is receiver and add to persons array
                  }

                  

                  $persons=array_unique($persons);  //remove same persons

                  foreach ($persons as $value) {
                    
                    echo "<a href='privatechat.php?previouschat=".$value."' class='nav-link'> $value </a>"; //show each person clickable to access them for chat
 
                  }
              ?>
          </div>



     </div>

    
 







  </body>
</html>

