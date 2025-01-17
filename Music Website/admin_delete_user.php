<?php
session_start();
if (!isset($_SESSION['loggedin'])||$_SESSION['loggedin']!=true) {
    header("location: admin_signin.php");
    exit;
}
?>
<?php
 include "connection.php";
 $id = $_GET['id'];
 $sql1 = "DELETE FROM user_login WHERE `user_login`.`id` = '$id';";
 $res = mysqli_query($conn, $sql1);
 if ($res) {
  header("Location: admin_users.php?Deleted=true?$sql");
} else {
  header("Location: admin_users.php?Error=true");
}
?>
