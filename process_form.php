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
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "Congrats! You created an account with the user of " .$name. ", the id of " .$id. ",and the email of " .$email;
            echo "<a href='assignment4.php'>Return to Form</a>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
} else {
    //Verify User

}




?>