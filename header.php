<?php // header.php
session_start();
echo "<!DOCTYPE html>\n<html><head><script src='js/OSC.js'></script>";

include 'functions.php';

$userstr = ' (Guest)';

if (isset($_SESSION['user'])) {
    $user     = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr  = $user;
}
else $loggedin = FALSE;

echo "<title>$appname$userstr</title><link rel='stylesheet'" .
    "href='css/styles.css' type='text/css'>" .
    "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>".
    "<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js' type='text/javascript'></script>".
    "</head><body><div class='container'><header class='appname'>logged in as $userstr";

if ($loggedin) {
    echo "<ul class='menu'>" .
         "<li><a class='btn btn-default' href='members.php?view=$user'>Home</a></li>" .
         "<li><a class='btn btn-default' href='members.php'>Members</a></li>" .
         "<li><a class='btn btn-default' href='logout.php'>Log out</a></li></ul>" .
         "<div class='clearboth'></div>";
}
else {
    echo "<ul class='menu'>" .
         "<li><a class='btn btn-default' href='index.php'>Home</a></li>" .
         "<li><a class='btn btn-default' href='signup.php'>Sign up</a></li>" .
         "<li><a class='btn btn-default' href='login.php'>Log in</a></li></ul>" .
        "<div class='clearboth'></div>" .
         "<span class='info' id='loggedin'>&#8658; You must be logged in to " .
         "view this page.</span>";
}
echo "</header>";

?>