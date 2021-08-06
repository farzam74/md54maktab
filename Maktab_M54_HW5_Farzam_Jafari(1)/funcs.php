<?php

//return the value of session that we passed it 
function session_return($message){
    session_start();
    if(isset($_SESSION[$message])){
        return $_SESSION[$message];
    }
}

//return the value of cookie that we passed it 
function cookie_return($message){
    
    if(isset($_COOKIE[$message])){
        echo $_COOKIE[$message];
    }
}


//change array to Json file with array and filename arguments
function arrToJsonTxt($array,$fileName){
    $json=json_encode($array);
    file_put_contents($fileName,$json);
}


function arrToJsonTxtAppend($array,$fileName){
    $json=json_encode($array);
    file_put_contents($fileName,$json,FILE_APPEND);
}

//change Jsonfile to array with filename argument 
function jsonToArrTxt($fileName){
    $json=file_get_contents($fileName);
    $array=json_decode($json,true);
    return $array;
}

//get user index in multidimensional array,if doesn't find user return false
function getUserIndex($searchBy,$array,$column){

   return array_search($searchBy , array_column($array ?? [], $column ?? 0));

}


// function for add contacts by post index argument,if there isn't any error this would add contact with user 
// cookie index, else if there are errors, this function returns suitable errors.
function addContact($searchMode){
    if(isset($_POST[$searchMode])){

        $user=$_COOKIE['username'];
        $usersArray=jsonToArrTxt('users.txt');
        $contactsArray=jsonToArrTxt('contacts.txt');
        $$searchMode=$_POST[$searchMode]; //assign email or username based on post method
        $nullArray=[];


       
        $searchResult=getUserIndex($$searchMode,$usersArray['users'],$searchMode);  //index of input user in users.txt file if input is on users.txt else return false.
       
       if($searchResult === false){ //if search doesn't find any match

            echo "<span class='text-danger'>There is no user with this $searchMode </span><br>";

        }

        else {

            $flag=false;
            foreach ($contactsArray[$user]??$nullArray as $value) {
                
                $indexOfContact=array_search($value,array_column($usersArray['users'],'username')); //index of each contact of user in users.txt file


                if($$searchMode === $usersArray['users'][$indexOfContact][$searchMode]){ //if input has added before
                    
                    $flag=true;
                    echo "This contact has added before <br>";
                    break;

                }

            }


            if($flag == false){

                $contactsArray[$user][]=$usersArray['users'][$searchResult]['username'];
                arrToJsonTxt($contactsArray,'contacts.txt');

            }

        }

  } 
}


//filter messages that contains a specific sender and receiver of an pvchats array:
 function filterMessage($array,$key1,$keyValue1,$key2,$keyValue2){

     return array_filter($array,function($value) use ($key1,$keyValue1,$key2,$keyValue2){

        return ($value[$key1]==$keyValue1 && $value[$key2]==$keyValue2) || ($value[$key1]==$keyValue2 && $value[$key2]==$keyValue1);

     });
 }

 //to filter persons who user chat with them in pvchats.txt file
 function filterPersons($array,$key1,$key2,$keyValue){

    return array_filter($array,function($value) use ($key1,$keyValue,$key2){

       return ($value[$key1]==$keyValue xor $value[$key2]==$keyValue ); //not and, a or b but noth both
    });
}