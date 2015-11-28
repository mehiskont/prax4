<?php // index.php
include_once 'header.php';

echo "<div class='main'>Welcome to $appname,";

if ($loggedin) echo " <script>window.location.replace('members.php?view=$user');</script>";
else           echo ' please sign up and/or log in to join.';

?>

</div>
</div>  <!-- footer -->
</body>
</html>