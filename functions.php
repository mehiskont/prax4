<?php // functions.php
include 'config.php';

// Create tables during setup process in setup.php
function createTable($name, $query) {
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table '$name' created or already exists.<br>";
}

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

   /* $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");

    if (mysql_num_rows($result)) {
        $row = mysql_fetch_row($result);
        if($row[2]) echo "Name: " . stripslashes($row[2]) . "<br>";
        echo "About: " . stripslashes($row[1]) . "<br clear='left'><br>";
    } */
}
?>