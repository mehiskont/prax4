<?php // signup.php
include_once 'header.php';

echo <<<_END
<script>
// Hide "you must be logged in..." message
document.getElementById('loggedin').style.display = 'none';

function checkUser(user) {
    if (user.value == '') {
        O('info').innerHTML = '';
        return;
    }

    params  = "user=" + user.value;
    request = new ajaxRequest();
    request.open("POST", "checkuser.php", true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.setRequestHeader("Content-length", params.length);
    request.setRequestHeader("Connection", "close");

    request.onreadystatechange = function() {
        if (this.readyState == 4)
            if (this.status == 200)
                if (this.responseText != null)
                    O('info').innerHTML = this.responseText;
        };
    request.send(params);
}

function ajaxRequest() {
    try { var request = new XMLHttpRequest() }
    catch(e1) {
        try { request = new ActiveXObject("Msxml2.XMLHTTP") }
        catch(e2) {
            try { request = new ActiveXObject("Microsoft.XMLHTTP") }
            catch(e3) {
                request = false;
            }
        }
    }
    return request;
}
</script>
<div class='main'><h3 id="signup">Please enter your details to sign up</h3>
_END;

$error = $user = $pass = $pass2 = $token = $email = $bio = $gender = $name = "";


if (isset($_SESSION['user'])) destroySession();

if (isset($_POST['user'])) {
    $user  = sanitizeString($_POST['user']);
    $pass  = sanitizeString($_POST['pass']);
    $pass2 = sanitizeString($_POST['pass2']);
    $email = sanitizeString($_POST['email']);
    $name = sanitizeString($_POST['name']);
    $bio = sanitizeString($_POST['bio']);
    $gender = $_POST['gender'];
    $token = password_hash("$pass", PASSWORD_BCRYPT); // Hash and salt passwords





    if ($user == "" || $pass == "" || $email == "")
        $error = "<span class='error'>Not all fields were entered</span><br><br>";
    else {
        if (mysql_num_rows(queryMysql("SELECT * FROM members WHERE user='$user'")))
            $error = "<span class='error'>That username already exists</span><br><br>";
        elseif (mysql_num_rows(queryMysql("SELECT * FROM members WHERE email='$email'")))
            $error = "<span class='error'>That email already exists</span><br><br>";
        elseif ($pass != $pass2) {
            $error = "<span class='error'>The passwords you entered do not match</span><br><br>";
        }
        else {
            include_once 'file_upload.php';
            $avatar_id = $new_file_name;

            queryMysql("INSERT INTO members VALUES('$user', '$token', '$name', '$email', '$gender', '$avatar_id','$bio' )");
            echo "<script> $('#signup').hide(); </script>";
            die("<h4>Account created</h4>Please <a href='login.php'>Log in</a>.<br><br>");
        }
    }
}





echo <<<_END

<form method='post' action='signup.php' enctype='multipart/form-data'>
    $error
    <div class="form-group">
         <label class='fieldname'>name</label>
        <input class="form-control" type='text' maxlength='30' name='name' value='$name'  required>
    </div>
    <div class="form-group">
         <label class='fieldname'>email</label>
        <input class="form-control" type='text' maxlength='30' name='email' value='$email' onBlur='checkUser(this)' autofocus required>
    </div>
    <div class="form-group">
         <label class='fieldname'>gender</label>
         <select class="form-control" name="gender">
              <option value="male">male</option>
              <option value="female">female</option>
          </select>
    </div>
    <div class="form-group">
        <label class='fieldname'>upload a profile picture</label>
        <input class="form-control" type="file" name="fileToUpload" id="fileToUpload" required>
    </div>
    <div class="form-group">
        <label class='fieldname'>bio</label>
        <textarea class="form-control" rows="5" name='bio' value="$bio" required> </textarea>
    </div>
    <hr>
    <div class="form-group">
        <label class='fieldname'>Username</label>
        <input class="form-control" type='text' maxlength='16' name='user' value='$user' onBlur='checkUser(this)' autofocus required>
    </div>
    <div class="form-group">
        <label class='fieldname'>Password</label>
        <input class="form-control" type='password' maxlength='16' name='pass' value='$pass' required><br>
    </div>
    <div class="form-group">
        <label class='fieldname'>Confirm Password</label>
        <input class="form-control" type='password' maxlength='16' name='pass2' required><br>
    </div>


_END;
?>


    <input class="btn btn-default" type='submit' value='Sign up'>
</form>
</div>
</div>  <!-- footer -->

<br>
</body>
</html>