<?php
// Step 1: Connect to the database
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "melo";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Fetch album details and album cover from the database
$album_name = $_GET['navigate']; 
$sql_album = "SELECT * FROM albums WHERE Album = '$album_name'";
$res_album = mysqli_query($conn, $sql_album);
$album_row = mysqli_fetch_assoc($res_album);

// Step 3: Fetch audio files from the database for a specific album
$sql_songs = "SELECT * FROM songs WHERE Album = '$album_name'";
$res_songs = mysqli_query($conn, $sql_songs);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album</title>
    
</head>
<body style="background: linear-gradient(135deg, #667eea, #764ba2);background-position: center;
  background-size: cover;
  position: relative; color: magenta; text-align: center; ">
<h1><?php echo $album_name; ?></h1>
<?php
// Display album name and cover
if ($album_row) {
    $album_cover = $album_row['Album_cover'];
    echo "<img src='$album_cover' alt='$album_name' style='width: 400px; height: 300px;'>";
} else {
    echo "Album details not found";
}

// Step 4: Display audio players for each audio file fetched from the database
if (mysqli_num_rows($res_songs) > 0) {
    while ($row = mysqli_fetch_assoc($res_songs)) {
        $audio = $row["audio"];
        $title = $row["Title"];
        
        echo "<p>$title</p>";
        echo "<audio controls>";
        echo "<source src='$audio' type='audio/mpeg'>";
        echo "Your browser does not support the audio element.";
        echo "</audio>";
        echo "<br>";
    }
} else {
    echo "No songs found for this album";
}
?>
<a href="album.php" style="color: pink;">Back</a>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
