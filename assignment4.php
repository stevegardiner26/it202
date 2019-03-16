<?php
/**
 * Created by PhpStorm.
 * User: steve
 * Date: 3/16/2019
 * Time: 12:55 PM
 */
$servername = "sql.njit.edu";
$username = "spg28";
$password = "ZbkSoE9x";
$dbname = "spg28";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$action = '';
$action = $_POST['transaction'];

if ($action == 'create') {
    echo '
        <form action="assignment4.php" method="post">
            <input name="classname" type="text">
            <input name="trainer" type="text">
            <input name="times" type="text">
            <input type="submit">
        </form>
    ';
} elseif ($action == 'remove') {

} elseif ($action == 'search') {
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo '
                <div style="margin: auto;">
                    <h1>Patron Name: ' . $row['name'] . '</h1>
                    <h2>Patron Id: ' . $row['patron_id'] . '</h2>
                    <h2>Patron Email: ' . $row['email'] . '</h2>
                    <table class="table" style="border: 1px solid black;">
                        
                    </table>
                </div> 
            ';
            $patron_schedule = $row['schedule'];
            foreach ($patron_schedule as $schedules) {
                $schedules[''];
            }
        }
    } else {
        echo "0 results";
    }
    $conn->close();
} elseif ($action == 'registerPatron') {

}
echo "ebola";