<?php
session_start();
if (!isset($_SESSION['loggedin'])||$_SESSION['loggedin']!=true) {
    header("location: admin_signin.php");
    exit;
}
?>
<?php
 include "connection.php";
 $title = $_GET['title'];
 $sql = "DELETE FROM songs WHERE `songs`.`Title` = '$title';";
 $res = mysqli_query($conn, $sql);
 if ($res) {
  header("Location: admin_songs.php?Deleted=true?$sql");
} else {
  header("Location: admin_songs.php?Error=true");
}
?>