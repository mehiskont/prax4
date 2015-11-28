<?php // members.php
include_once 'header.php';

/* if (!loggedin) die(); */

echo "<div class='main'>";

if (isset($_GET['view'])) {
    $view = sanitizeString($_GET['view']);

    if ($view == $user) $name = "Your";
    else                $name = "$view's";

    echo "<h3>$name Profile</h3>";

    showProfile($view);

    die("</div></body></html>");
}

//echo $user;

$offset = 0;

$gender_result = queryMysql("SELECT gender FROM members WHERE user='$user'");

$gender_row = mysql_fetch_row($gender_result);

$result = queryMysql("SELECT * FROM members WHERE gender !='$gender_row[0]' ORDER BY user ");

$num    = mysql_num_rows($result);




for ($j = 0 ; $j < $num ; ++$j) {
    $row = mysql_fetch_row($result);

    if ($row[0] == $user || $row[4] == $gender_row[0]) continue;

    echo "<div id='count-$j' class='counter'>";
    echo "<div class='user-wrap'><img src='uploads/$row[5]'></div>";
    echo "<div class='text-center user-link'><a href='members.php?view=$row[0]'>$row[0]</a></div>";
    echo "<div class='text-center user-link'>$row[6]</div>";
    echo "<div class='like-nope'>";
    ?>

        <button class='btn btn-default js-btn' type="submit" name="LIKE" value="LIKE" >LIKE</button>
        <button class='btn btn-default js-btn' type="submit" name="NOPE" value="NOPE" >NOPE</button>

    <?
    echo "</div>";
    echo "</div>";
}


?>


<script>

    var counter = 0;
    var length =  $(".counter").length;

    $(".js-btn").click(function() {
        counter++;
        $(".counter").css("display","none");
        if (counter == length) {
            counter = 0;
        }
        $("#count-" + counter).css("display","block");
    });


    
</script>

<br>
</div>
</div>  <!-- footer -->
</body>
</html>