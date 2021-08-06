<?php

// require_once 'signup.php';

//define closure func for validation:
    function validate(Closure $type,$input){
        return $type($input);
    }

  //validation functions:
$name_func= function($input){
    $fullnamepattern="/^[A-Za-z]+\s[A-Za-z]+$/";
    $namelen=strlen($input);

    if($namelen==0){
      return "Fullname must not be empty.";
    }

    elseif($namelen<6){
       return "Full name must have more than 5 charachters";
    }

    elseif(!preg_match($fullnamepattern,$input)){

        return "Full name is invalid";
    }
    else return true;
};

$username_func=function($input){
    $usernamepattern="/^[A-Za-z1-9_#@]+$/";;
    $unamelen=strlen($input);

    if($unamelen==0){
      return "Username must not be empty.";
    }


    elseif($unamelen<4){

        return "Username must have more than 3 charachters";

    }

    elseif(!preg_match($usernamepattern,$input)){

        return "Username is invalid";
    }

    else return true;

};


$email_func=function($input){

    $maillen=strlen($input);

    if($maillen==0){
      return "Email must not be empty.";
    }

    elseif(!filter_var($input,FILTER_VALIDATE_EMAIL)){

      return "Please enter a valid email address";

    }
    
    else return true;
};

$pass_func=function($input){
    $passlen=strlen($input);
    
    if($passlen==0){
      return "Password must not be empty.";
    }

    elseif($passlen<6){

      return "Password must have more than 5 charachters";

       }

    else return true;   


};



  //function for return result of validation,if it is true,this return 1 else this return a suitable message to user:
    function post_return($input,$func){
        if(count($_POST)>0){
          $input=$_POST[$input];  
          return validate($func,$input);
        }
      }
      
      //to show error message:
      function error_return($input,$func){
        if(count($_POST)>0){
          $input=$_POST[$input];  
          if (validate($func,$input) != 1) echo "<span class='text-danger'>".validate($func,$input)."</span>"; 
        }
      }










