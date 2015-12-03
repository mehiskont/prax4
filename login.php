<?php // login.php
include_once 'header.php';
echo "<div class='main'><h3>Please enter your details to log in</h3>";
$error = $user = $pass = $hash = $verify = $row = '';

if (isset($_POST['user'])) {
    $user   = sanitizeString($_POST['user']);
    $pass   = sanitizeString($_POST['pass']);

    if ($user == "" || $pass == "") {
        $error = "<span class='error'>Not all fields were entered<br></span>";
    }
    else {
        $query  = "SELECT user,pass FROM members WHERE user='$user'";
        $result = queryMysql($query);
        $row    = mysql_fetch_row($result);
        $hash   = $row[1];
        $verify = password_verify($pass, $hash);

        if (!$verify) {
            $error = "<span class ='error'>Username/Password
                invalid</span><br><br>";
        }
        elseif ($verify) {
            $_SESSION['user'] = $user;
            $_SESSION['pass'] = $pass;
            echo "<script>window.location.replace('members.php?view=$user');</script>";
            die("You are now logged in. Please <a href='members.php?view=$user'>" .
                "click here</a> if you are not automatically redirected.<br><br>");
        }
    }
}

echo <<<_END
<form method='post' action='login.php'>$error

    <div class="form-group">
        <label class='fieldname'>Username</label>
        <input class="form-control" type='text' maxlength='16' name='user' value='$user' autofocus><br>
    </div>
     <div class="form-group">
        <label class='fieldname'>Password</label>
        <input class="form-control" type='password'maxlength='16' name='pass' value='$pass'>
    </div>

<script>
// Hide "you must be logged in..." message
document.getElementById('loggedin').style.display = 'none';
</script>
_END;
?>

<br>
<span class='fieldname'>&nbsp;</span>
<input class="btn btn-default" type='submit' value='Login'>
</form><br>
</div>
</div>  <!-- footer -->
</body>
</html>