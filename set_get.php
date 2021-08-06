<?php

//cookie and session functions:
function set_cookie($name,$value,array $options=[]){
    if (array_key_exists($name,$_COOKIE)){
        setcookie($name,$value,$options);
    }
    

}


function get_cookie($name){
    if (array_key_exists($name,$_COOKIE)){
        return $_COOKIE[$name];
    }
    else return 0;
}

function unset_cookie($name){
    if (array_key_exists($name,$_COOKIE)){
        setcookie($name,"",time()-1);
    }
}