<!DOCTYPE html>
<html>
  <head>
    <title>Live Weather Update</title>
    <link rel="stylesheet" type="text/css" href="./index.css">
  </head>
  <body>
    <div class="container">
      <h1>Weather Update</h1>
      <span class="month"></span>
    </div>
    
    </div>
    <div class="description">
      <div class="location">
        <h1 id="loc">Location</h1>
        <div class="search-bar">
          <input type="text" id="search" placeholder="Search location" onkeydown="if (event.keyCode === 13) searchMe()">
        </div>
      <img id="icon" style="width: 20%;"><br>
      <span id="temperature"></span><br>
      <span id="description"></span><br>
      <span class="wind"></span><br>
      <span class="humidity"></span>
    </div>
    <script src="./index.js"></script>
 
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "weather_app";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (isset($_POST['city'])) {
    $city = $_POST['city'];
    $API_Key = "0cd246df5f8e2447e6f2c3cdcf5053f1";

    $url = "https://api.openweathermap.org/data/2.5/weather?q=".$city."&units=metric&appid=".$API_Key;

    // Make API call and retrieve weather data
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    // Get the relevant data from the API response
    $city_name = $data['name'];
    $country = $data['sys']['country'];
    $temperature = $data['main']['temp'];
    $description = $data['weather'][0]['description'];
    $icon = $data['weather'][0]['icon'];
    $wind = $data['wind']['speed'];
    $humidity = $data['main']['humidity'];
    
    // Generate the current date
    $date = date('Y-m-d');
    $day = date('l', strtotime($date));

    // Insert data into "weather" table
    $sql = "INSERT INTO weather(day, city, country, temperature, description, icon, wind, humidity, date) 
    VALUES ('$day', '$city_name', '$country', '$temperature', '$description', '$icon', '$wind', '$humidity', '$date')";
    if (mysqli_query($conn, $sql)) {
        echo "Data inserted successfully for date $date. <br>";
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
 </body>
</html>