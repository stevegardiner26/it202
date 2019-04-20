<?php
/**
 * Created by PhpStorm.
 * User: stevegardiner
 * Date: 2019-04-19
 * Time: 18:04
 */

$type = $_POST['type'];
$name = $_POST['name'];
$password = $_POST['password'];
$content = $_POST['content'];

$servername = "sql.njit.edu";
$username = "spg28";
$dbpassword = "ZbkSoE9x";
$dbname = "spg28";
$result4 = '';

$conn = new mysqli($servername, $username, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($type == 'write') {
    $result = $conn->query("SELECT * FROM chats WHERE `name` = " . $name . " AND `password` = " . $password);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $result4 = $conn->query("UPDATE chats SET `chat_content` = ". $content ." WHERE `name` = " . $row['name'] . " AND `password`='" . $row['password'] . "'");
        }
    } else {
        $result4 = $conn->query("INSERT INTO chats (`name`, `password`, `chat_content`) VALUES (`" . $name . "`,`" . $password . "`,`" . $content . "`)");
    }
} else {
    $result = $conn->query("SELECT chat_content FROM chats WHERE `name` = " . $name . " AND `password` = " . $password);
    $result4 = $result;
}

echo json_encode($result4);

$conn->close();