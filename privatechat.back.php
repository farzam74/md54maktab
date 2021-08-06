<?php
include 'set_get.php';

if(count($_POST)>0){
    
    $inputs=$_POST;
    $message=$inputs['message'];

    $json=file_get_contents('pvchats.txt');
    $array=json_decode($json,true);
    $sender=$_COOKIE['username'];
    $receiver=$_COOKIE['receiver'];

    if (isset($_FILES['image'])) {  //check if file upload clicked


        $image = $_FILES['image'];
        $name =$image['name'];
        $type=$image['type'];
        $tmp_name = $image['tmp_name'];
        $size=$image['size'];

        if($size<10000000 && (($type == "image/gif") //check if uploaded file have requirements of type and size.
        || ($type == "image/jpeg")
        || ($type == "image/jpg")
        || ($type == "image/pjpeg")
        || ($type == "image/x-png")
        || ($type == "image/png"))){
            
        $success=move_uploaded_file($tmp_name, "images/".$name); //if upload was successfully this method move the image file from tem-folder to upload folder of site


        //add each message that contains image with that timestamp and sender and receiver details to array to put in pvchats.txt file.
        $array[]=[ 
            'timestamp' => time(),
            'sender' => $sender,
            'receiver' => $receiver,
            'message' => $message,
            'image' => "images\\$name"
        ]; 
        
        //unset session errors of file to don't show them if messages sended successfully
        session_start();
        unset($_SESSION['file-size']);
        unset($_SESSION['file-type']);

        }

        //check if file doesn't have suitable type or size and set their errors in session to show in privatechat page
        elseif( !(($type == "image/gif")

        || ($type == "image/jpeg")
        || ($type == "image/jpg")
        || ($type == "image/pjpeg")
        || ($type == "image/x-png")
        || ($type == "image/png"))){

            session_start();
            $_SESSION['file-type']='This is not an image file';

            //if message is without any upload unset session error of file type 
            if($size == null){
                unset(  $_SESSION['file-type']);
            }

        }

        elseif($size>10000000 ){

            session_start();
            $_SESSION['file-size']='File must not be more than 10 MB of size';
        }

        else{
            session_start();
            unset($_SESSION['file-size']);
            unset($_SESSION['file-type']);
        }
    }


    if($success == null) {

        $array[]=[ 
        'timestamp' => time(),
        'sender' => $sender,
        'receiver' => $receiver,
        'message' => $message,
    ]; //add each message with that timestamp and sender and receiver details to array to put in pvchats.txt file.
    
    
    }   
    $json=json_encode($array);
    file_put_contents('pvchats.txt',$json);
    header("Location: privatechat.php#form"); //for redirect to end of chatroom page
    exit;
}


    


