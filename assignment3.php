<?php
$servername = "sql.njit.edu";
$username = "spg28";
$password = "ZbkSoE9x";
$dbname = "spg28";

$dbType = $_POST["display"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($dbType == "classes") {
    $sql = "SELECT * FROM classes";
} else {
    $sql = "SELECT * FROM patrons";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if($dbType == "classes") {
            echo "Class Name: " . $row["name"]. "  -Trainer: " . $row["trainer"]. " -Date/Time: " . $row["time"]. "<br>";
        } else {
            echo "Id: " . $row["patron_id"]. "  -Name: " . $row["name"]. " -Email: " . $row["email"]. " Schedule: " . $row["schedule"] . "<br>";
        }
    }
} else {
    echo "0 results";
}
$conn->close();
?>