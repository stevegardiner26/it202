<?php
/**
 * Created by PhpStorm.
 * User: stevegardiner
 * Date: 2019-04-03
 * Time: 19:15
 */
$servername = "sql.njit.edu";
$username = "spg28";
$password = "ZbkSoE9x";
$dbname = "spg28";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['class'];
    $times = $_POST['time'];
    $trainer = $_POST['trainer'];
    $id = $_POST['id'];
} else {
    $name = $_GET['class'];
    $id = $_GET['id'];
}

$result = $conn->query("SELECT * FROM courses WHERE `patron_id` = " . $id);
if ($result->num_rows > 0) {
    echo '<h2>Before:</h2><table class="table" style="border: 1px solid black;"><tr><th>Class Name</th><th>Trainer</th><th>Times</th></tr>';
    while ($row = $result->fetch_assoc()) {
        echo '
                       <tr>
                           <td>' . $row['name'] . '</td>
                           <td>' . $row['trainer'] . '</td>
                           <td>' . $row['times'] . '</td>
                       </tr>
                   ';
    }
    echo '</table><br><br><br>';
} else {
    echo 'This Account does not have any classes! <br><br>';
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($conn->query("INSERT INTO courses (`patron_id`, `name`, `trainer`, `times`) VALUES (" . $id . ", '" . $name . "', '" . $trainer . "', '" . $times . "')") === TRUE) {
        echo "New class scheduled successfully<br><br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error . "<br><br>";
    }
} else {
    if ($conn->query("DELETE FROM courses WHERE `patron_id` = ".$id." AND `name` = '".$name."'") === TRUE) {
        echo "New class deleted successfully<br><br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error . "<br><br>";
    }
}

$result2 = $conn->query("SELECT * FROM courses WHERE `patron_id` = " . $id);
if ($result2->num_rows > 0) {
    echo '<h2>After:</h2><table class="table" style="border: 1px solid black;"><tr><th>Class Name</th><th>Trainer</th><th>Times</th></tr>';
    while ($row2 = $result2->fetch_assoc()) {
        echo '
                       <tr>
                           <td>' . $row2['name'] . '</td>
                           <td>' . $row2['trainer'] . '</td>
                           <td>' . $row2['times'] . '</td>
                       </tr>
                   ';
    }
    echo '</table>';
    echo "<br><a href='assignment4.php'>Return to Form</a> <br><br>";
} else {
    echo"No Classes Currently Assigned!";
    echo "<br><a href='assignment4.php'>Return to Form</a> <br><br>";
}

$conn->close();
?>