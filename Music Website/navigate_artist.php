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

// Step 2: Fetch audio files from the database for a specific album
$album_name = $_GET['navigates']; 
$sql = "SELECT * FROM albums WHERE Album = '$album_name'";
$res = mysqli_query($conn, $sql);

$sql_artist = "SELECT * FROM artists WHERE Artist = '$album_name'";
$res_artist = mysqli_query($conn, $sql_artist);
$artist_row = mysqli_fetch_assoc($res_artist);

$sql_songs = "SELECT a.Artist, a.no_songs, b.audio, b.Title
        FROM artists a
        INNER JOIN songs b ON a.Artist = b.Artist
        WHERE a.Artist = '$album_name'";
$res_songs = mysqli_query($conn, $sql_songs);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artists</title>
    
</head>
<body style="background: linear-gradient(135deg, #667eea, #764ba2);background-position: center;
  background-size: cover;
  position: relative; color: magenta; text-align: center; ">
<?php
// Step 3: Display artist name and photo
if ($artist_row) {
    $artist_photo = $artist_row['Artist_cover'];
    echo "<h3>$album_name</h3>";
    echo "<img src='$artist_photo' alt='$album_name' style='width: 200px; height: auto;'>";
} else {
    echo "Artist details not found";
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
    echo "No songs found for this artist";
}
?>
<a href="artist.php" style="color: pink;">Back</a>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
