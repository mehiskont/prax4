<?php // profile.php
include_once 'header.php';

if (!$loggedin) die();

echo "<div class='main'><h3>Your Profile</h3>";

// Update name following form submit
if (isset($_POST['realname'])) {
    $realname = sanitizeString($_POST['realname']);
    $realname = preg_replace('/\s\s+/', ' ', $realname);

    if (mysql_num_rows(queryMysql("SELECT * FROM profiles WHERE user='$user'")))
        queryMysql("UPDATE profiles SET realname='$realname' WHERE user='$user'");
    else queryMysql("INSERT INTO profiles (user, realname) VALUES('$user', '$realname')");
}
else {
    $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");

    if (mysql_num_rows($result)) {
        $row  = mysql_fetch_row($result);
        $realname = stripslashes($row[2]);
    }
    else $realname = "";
}

$realname = stripslashes(preg_replace('/\s\s+/', ' ', $realname));

// Update 'about me' text following form submit
if (isset($_POST['text'])) {
    $text = sanitizeString($_POST['text']);
    $text = preg_replace('/\s\s+/', ' ', $text);

    if (mysql_num_rows(queryMysql("SELECT * FROM profiles WHERE user='$user'")))
         queryMysql("UPDATE profiles SET text='$text' WHERE user='$user'");
    else queryMysql("INSERT INTO profiles (user, text) VALUES('$user', '$text')");
}
else {
    $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");

    if (mysql_num_rows($result)) {
        $row  = mysql_fetch_row($result);
        $text = stripslashes($row[1]);
    }
    else $text = "";
}

$text = stripslashes(preg_replace('/\s\s+/', ' ', $text));

if (isset($_FILES['fileToUpload'])) {
    include_once 'file_upload.php';
}



echo <<<_END
<form method='post' action='profile.php' enctype='multipart/form-data'>
<label for='realname'><h3>Name</h3></label>
<input type='text' name='realname' value='$realname'></input>
<h3>Enter or edit your details and/or upload an image</h3>
<textarea name='text' cols='50' rows='3'>$text</textarea><br>

 <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
_END;
?>



</div><br>
</div>  <!-- footer -->
</body>
</html>