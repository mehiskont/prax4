<?php // index.php
include_once 'header.php';

echo "<div class='main text-center'>Welcome to Social,";

if ($loggedin) echo " <script>window.location.replace('members.php?view=$user');</script>";
else           echo ' please sign up or log in.';

?>

</div>
</div>  <!-- footer -->
</body>
</html>