<?php // header.php
session_start();
echo "<!DOCTYPE html>\n<html><head>";

include 'functions.php';

$userstr = '';

if (isset($_SESSION['user'])) {
    $user     = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr  = $user;
}
else $loggedin = FALSE;


echo "<title>$appname</title><link rel='stylesheet'" .
    "href='css/styles.css' type='text/css'>" .
    "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>".
    "<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js' type='text/javascript'></script>".
    "</head><body><div class='container'><header class='header'>  ";
echo "<div class='pos-abs-left'> <img class='logo-icon' src='icon.svg'></div> ";
if ($loggedin) {
    echo
         "<a class='btn btn-default' href='members.php?view=$user'>Home</a>" .
         "<a class='btn btn-default' href='members.php'>Members</a>" .
         "<a class='btn btn-default' href='logout.php'>Log out</a>" .
         "<div class='clearboth'></div>";
}
else {
    echo
         "<a class='btn btn-default' href='index.php'>Home</a>" .
         "<a class='btn btn-default' href='signup.php'>Sign up</a>" .
         "<a class='btn btn-default' href='login.php'>Log in</a>" .
        "<div class='clearboth'></div>" ;

}
echo "</header>";

?>