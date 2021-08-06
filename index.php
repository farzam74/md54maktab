<?php
if(isset($_COOKIE['username'])) header("Location: publicchat.php");
else header("Location: signin.php");