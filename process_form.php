<?php
/**
 * Created by PhpStorm.
 * User: stevegardiner
 * Date: 2019-04-02
 * Time: 21:01
 */

$servername = "sql.njit.edu";
$username = "spg28";
$password = "ZbkSoE9x";
$dbname = "spg28";

$type = $_POST['transaction'];
$email = $_POST['email'];
$name = $_POST['name'];
$id = $_POST['id'];

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//If the User is Creating an Account Create it with the information
if($type == 'create') {
    $sql = "INSERT INTO patrons (`name`, `patron_id`, `email`, `schedule`) VALUES (`" . $name . "`,`" . $id . "`,`" . $email . "`,``)";
    $result = $conn->query($sql);
    echo "Congrats! You created an account with the user of " .$name. ", the id of " .$id. ",and the email of " .$email;
    echo "<br><a href='assignment4.php'>Return to Form</a>";
    $conn->close();
} else {
    //Verify User
    $sql = "SELECT * FROM patrons WHERE `patron_id` = " . $id . " AND `name`='" . $name . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '
                  <div style="margin: auto;">
                      <h1>Patron Name: ' . $row['name'] . '</h1>
                      <h2>Patron Id: ' . $row['patron_id'] . '</h2>
                      <h2>Patron Email: ' . $row['email'] . '</h2>
                  </div>
                  <h2>Classes</h2>
               ';
        }
        if($type == 'view') {
            $result2 = $conn->query("SELECT * FROM courses WHERE `patron_id` = " . $id);
            if ($result2->num_rows > 0) {
                echo '<table class="table" style="border: 1px solid black;"><tr><th>Class Name</th><th>Trainer</th><th>Times</th></tr>';
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
                echo "<br><a href='assignment4.php'>Return to Form</a>";
            } else {
                echo "You are not registered for any classes yet.";
                echo "<br><a href='assignment4.php'>Return to Form</a>";
            }
        }
    } else {
        echo "Your Account is Invalid!";
        echo "<br><a href='assignment4.php'>Return to Form</a>";
    }
    $conn->close();
}

/* vwhile($row = $result->fetch_assoc()) {
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
        } */




?>