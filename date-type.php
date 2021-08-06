<?php

    
    //this file created to determine which type of date use to show date of messages via item that user select in select box in profile.
    require_once 'funcs.php';
    
    $array=jsonToArrTxt('users.txt');

    $index=getUserIndex($_COOKIE['username'],$array['users'],'username');

    $dateType=$_POST['date-type'];  

    $array['users'][$index]['date-type']=$dateType; //change date type of user account in array of user in users.txt file
    
    $replacedArr= $array['users'][$index];

    array_replace_recursive($array,$replacedArr); //replace new array with new date type to old array, array_replace_recursive just change the value of array element that we passed that index to it. 

    arrToJsonTxt($array,'users.txt');

    header("Location: profile.php");
    exit;