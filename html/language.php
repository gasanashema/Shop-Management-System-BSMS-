<?php
@session_start();
include "../includes/connect.php";

if (isset($_GET['language'])) {
    $language = $_GET['language'];
    $_SESSION['language'] = $language;
$change_user_language=mysqli_query($con,"UPDATE accounts SET language='$language' WHERE type='$_SESSION[user]'");
}


echo "<script>window.location.href='index.php';</script>";; // Redirect back to your main page
exit;

?>