<?php
include 'set_get.php';
require_once 'funcs.php';


//set message with details in chats.txt file
if(count($_POST)>0){
    
    $inputs=$_POST;
    $message=$inputs['message'];
    $array=jsonToArrTxt('chats.txt');
    $username=$_COOKIE['username'];
    
    
    //check 100 characters:
    if(strlen($message)<=100){

       //I used this format of array for sort messages by date and not just by users.
        $array[]=[ 
            'timestamp' => time(),
            'sender' => $username,
            'message' => $message,
        ];  

        unset_cookie('charLimit');

        arrToJsonTxt($array,'chats.txt');

        header("Location: publicchat.php#form"); //for redirect to end of chatroom page
        exit;
    }
    else{
        setcookie('charLimit','The message must has less than 100 characters');
        header("Location: publicchat.php#form");
        exit;
    }

    }


