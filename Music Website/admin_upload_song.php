<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: admin_signin.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include "connection.php";

    $title = $_POST["Title"];
    $artist = $_POST["Artist"];
    $album = $_POST["Album"];

    $target_dir = "audio/"; 
    $audio_file = $target_dir . basename($_FILES["audio"]["name"]); 
    move_uploaded_file($_FILES["audio"]["tmp_name"], $audio_file); 
    $sql = "INSERT INTO songs (title, artist, album, audio) VALUES ('$title', '$artist', '$album', '$audio_file')";
    if (mysqli_query($conn, $sql)) {
        header("Location: admin_songs.php"); 
        exit;
    } else {
        
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
