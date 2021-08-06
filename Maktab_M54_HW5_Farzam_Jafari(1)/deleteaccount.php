<?php

    
    //this file created to do tasks for delete account of user
    require_once "funcs.php";
    require_once "set_get.php";

    
    $onlineUsers=jsonToArrTxt('onlineusers.txt');

    $username=$_COOKIE['username'];

    $indexOnUser=array_search($username,$onlineUsers);

    unset($onlineUsers[$indexOnUser]);  //to remove deleted account user from online users file

    $onlineUsers=array_values($onlineUsers); //to re-index online users from 0 to count of them

    arrToJsonTxt($onlineUsers,'onlineusers.txt');

    $array=jsonToArrTxt('users.txt');

    $index=getUserIndex($username,$array['users'],'username'); //get user index in users.txt file to move that user from users array to delusers array in users.txt file.

    $email=$array['users'][$index]['email'];
    $fullname=$array['users'][$index]['fullname'];
    $password=$array['users'][$index]['password'];

    // delusers array is created to check new registers in site don't use their username or email:
    $array['delusers'][]=[

        'fullname' => $fullname,
        'username' => $username,
        'email' => $email,
        'pasword' => $password
    ];

    unset($array['users'][$index]);  //delete user from users array
    $array['users']=array_values($array['users']);

    arrToJsonTxt($array,'users.txt'); 

    header("Location: signup.php");
    exit();