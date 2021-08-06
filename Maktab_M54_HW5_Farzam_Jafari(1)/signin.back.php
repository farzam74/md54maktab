<?php
require_once 'funcs.php';
if(count($_POST)>0){
    
    $username=$_POST['username'];
    $password=$_POST['password'];
    $hashedPassword=md5($password);
    $json=file_get_contents('users.txt');
    $array=json_decode($json,true);
    $index=getUserIndex($username,$array['users'],'username');
    $onlineUsers=jsonToArrTxt('onlineusers.txt');


    if($index !== false && $hashedPassword == $array['users'][$index]['password']){  //if username has been defined before and passwords match.

        setcookie('username',$username);
        session_start();
        unset($_SESSION['error']);
        $onlineUsers[]=$username;  //add user who signed in to online users list
        arrToJsonTxt($onlineUsers,'onlineusers.txt'); 
        header("Location: publicchat.php"); 
        exit;

    }

    else{
        
        session_start();
        $_SESSION['error']='Incorrect username or password'; //set error of sign in in session
        header("Location: signin.php");
        exit;

    }


}