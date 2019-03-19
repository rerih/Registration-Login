<?php
require_once('header.php');
session_start();
if (!$_SESSION['username'] || !isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit;
}
displayPageHeader();
?>
<div class="header">
    <h1>Congratulation! You are logged in <?php echo  $_SESSION['username'] ?><a href='login.php?action=logout'>  Log Out</a></h1>;
</div>
</body>
</html>
