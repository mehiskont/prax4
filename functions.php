<?php // functions.php
include 'config.php';



// Query MySQL database or die and display error
function queryMysql($query) {
    $result = mysql_query($query) or die(mysql_error());
    return $result;
}

function destroySession() {
    $_SESSION=array();

    if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
}

function sanitizeString($var) {
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return mysql_real_escape_string($var);
}



function showProfile($user) {

    $query = queryMysql("SELECT * FROM members WHERE user='$user'");

    $row = mysql_fetch_row($query);


    $name = $row[2];
    $email = $row[3];
    $gender = $row[4];
    $profile_image = $row[5];
    $bio = $row[6];


    echo "<div class='display-flex'>".
        "<div class='left'>
        <ul>
            <li>name: $name</li>
            <li>email: $email</li>
            <li>gender: $gender</li>
            <li>bio: $bio</li>
        </ul>
        </div>".
        "<div class='right'><img src='uploads/$profile_image' align='left'></div>".
        "</div>";


}
?>