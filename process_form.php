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
        } else if($type == 'add') {
            echo '<form action="add_remove.php" method="post" style="margin: auto;">
                    <h3>Schedule a Class</h3>
                    <label for="id">ID:</label>
                    <input name="id" type="number" value="'.$id.'">
                    <label for="class">Class Name:</label>
                    <input name="class" type="text">
                    <label for="trainer">Trainer:</label>
                    <input name="trainer" type="text">
                    <label for="time">Time:</label>
                    <input name="time" type="text">
                    <input type="submit" value="Add Class">
                 </form>';
            echo "<br><a href='assignment4.php'>Return to Form</a>";
        } else if ($type == 'remove') {
            echo '<form action="add_remove.php" method="get" style="margin: auto;">
                    <h3>Remove a Class</h3>
                    <label for="id">ID:</label>
                    <input name="id" type="text" value="'.$id.'">
                    <label for="class">Class Name:</label>
                    <input name="class" type="text">
                    <input type="submit" value="Remove Class">
                 </form>';
            echo "<br><a href='assignment4.php'>Return to Form</a>";
        }
    } else {
        echo "Your Account is Invalid!";
        echo "<br><a href='assignment4.php'>Return to Form</a>";
    }
    $conn->close();
}
?>