<!DOCTYPE html>
<html lang="en">
<head>
    <title>pastWeek</title>
</head>
<body>
    
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "weather_app";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connection successful.";
}

$sql = 'SELECT * FROM `weather`';
$result = mysqli_query($conn, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        // OUTPUT DATA OF EACH ROW
        while ($row = mysqli_fetch_assoc($result)) {
            echo "City: " . $row["city"] . " - Temperature: " . $row["temperature"] . " | Wind: " . 
                $row["wind"] . " | Icon: " . $row["icon"] . " | Date: " . $row["date"] . "<br>";
        }
    } else {
        echo "No results found.";
    }
} else {
    echo "Error executing query: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
</body>
</html>