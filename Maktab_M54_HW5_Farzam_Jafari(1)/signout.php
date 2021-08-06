<?php

//this file is created to do sign out tasks 
include 'set_get.php';
include 'funcs.php';

$array=jsonToArrTxt('onlineusers.txt');
$key=array_search($_COOKIE['username'], $array);
unset($array[$key]);  //remove signed out user of online users list
arrToJsonTxt($array,"onlineusers.txt");

unset_cookie('username');
session_start();
session_unset();
header("Location: signin.php");