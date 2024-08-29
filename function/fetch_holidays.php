
<?php
$servername = "localhost"; // Adjust your server name
$username = "root"; // Adjust your username
$password = ""; // Adjust your password
$dbname = "veterans_db"; // Adjust your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, date FROM holidays";
$result = $conn->query($sql);

$holidays = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $holidays[] = array(
            'title' => $row['name'],
            'start' => $row['date']
        );
    }
} else {
    echo "0 results";
}
$conn->close();

// Return holidays in JSON format
header('Content-Type: application/json');
echo json_encode($holidays);
?>

