<?php
// Step 1: Connect to the database
$conn = mysqli_connect("localhost:3307", "root", "", "melo");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Step 2: Fetch audio files from the database
$sql = "SELECT Title, Artist, Album, audio FROM songs";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album</title>
    
</head>
<body style="background-color: indigo; color: magenta;">
<h1></h1>
<?php
// Step 3: Display audio players for each audio file fetched from the database
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $Album = $row["Title"];
        $audio = $row["audio"];

        echo "<h3>$Album</h3>";
        echo "<audio controls>";
        echo "<source src='$audio' type='audio/mpeg'>";
        echo "Your browser does not support the audio element.";
        echo "</audio>";
        echo "<br>";
    }
} else {
    echo "0 results";
}
?>
<a href="home1.php" style="color: pink;">Back</a>
</body>
</html>