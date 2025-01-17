<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Artists</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>

<section class="header">

<nav>
<a href="home1.php"><img src=""></a>
<div class="nav-links">
<ul>
<li><a href="./home1.php">home</a></li>
<li><a href="./artists.php">artist</a></li>
<li><a href="./album.php">album</a></li>
<li><a href="./song.php">songs</a></li>
</ul>
</div>
<form action="" method="GET">
<div class="search">
<input class="search-input" type="search" name="search" placeholder=""> 
<input type="submit" value="Search">
</div>
</form>
</nav>

<div class="playlist">
Artists
</div>
<div class="box">
<?php
// Connect to your database
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "melo";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize search term
$searchTerm = "";

// Check if search term is provided in the URL
if(isset($_GET['search'])) {
    $searchTerm = $_GET['search'];

    // Query to select artists based on search term
    $sql = "SELECT * FROM artists WHERE Artist LIKE '%$searchTerm%'";
} else {
    // Query to select all artists
    $sql = "SELECT * FROM artists";
}

$result = $conn->query($sql);

// Display artists as cards
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        ?>
<div class="katera">
<a href="./navigate_artist.php?navigates=<?php echo $row['Artist'] ?>"><button>
<img src="<?php echo $row['Artist_cover']; ?>">
<li><h1 class="card-title"><?php echo $row['Artist']; ?></h1></li></button>
</a>
</div>
<?php
    }
} 
$conn->close();
?>
<?php
// Connect to your database
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "melo";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchTerm = "";

if(isset($_GET['search'])) {
    $searchTerm = $_GET['search'];

    // Check if search term is not empty
    if (!empty($searchTerm)) {
        $sql = "SELECT * FROM songs WHERE audio LIKE '%$searchTerm%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <div class="song">
                    <h3><?php echo $row['Title']; ?></h3>
                    <p>Artist: <?php echo $row['Artist']; ?></p>
                    <p>Album: <?php echo $row['Album']; ?></p>
                    <audio controls>
                        <source src="<?php echo $row['audio']; ?>" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </div>
                <?php
            }
        } else {
            echo "0 results";
        }
    } else {
        echo "Please enter a search term.";
    }
}
?>
</div>
</section>
</body>
</html>
