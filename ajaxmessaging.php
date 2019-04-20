<?php
/**
 * Created by PhpStorm.
 * User: stevegardiner
 * Date: 2019-04-19
 * Time: 18:04
 */

$type = $_GET['type'];
$name = $_GET['name'];
$password = $_GET['password'];
$content = $_GET['content'];

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
            $result4 = $conn->query("UPDATE chats SET `chat_content` = '". $content ."' WHERE `name` = " . $name . " AND `password`='" . $password . "'");
        }
    } else {
        $result4 = $conn->query("INSERT INTO chats (`name`, `password`, `chat_content`) VALUES (`" . $name . "`,`" . $password . "`,`" . $content . "`)");
    }
} else if ($type == 'read'){
    $result = $conn->prepare("SELECT chat_content FROM chats WHERE `name` = ?");
    $result->bind_param("s", $name);
    $result->execute();
    $result->store_result();
    $result->bind_result($cont);
    $result->fetch();
    $result->close();
    $result4 = $cont;
}

echo $result4;

$conn->close();