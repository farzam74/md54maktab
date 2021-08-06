<?php


//this file created to redirect to profile page when  user clicked on edit button and show edit from
require_once 'form-control.php';

    setcookie('edit','yes');
    header("Location: profile.php");
    exit;
    