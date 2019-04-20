<?php
/**
 * Created by PhpStorm.
 * User: stevegardiner
 * Date: 2019-04-19
 * Time: 18:04
 */

$type = $_REQUEST['type'];
$name = $_REQUEST['name'];
$password = $_REQUEST['password'];
$content = $_REQUEST['content'];

$servername = "sql.njit.edu";
$username = "spg28";
$password = "ZbkSoE9x";
$dbname = "spg28";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($type == 'write') {
    $result = $conn->query("UPDATE  FROM courses WHERE `patron_id` = " . $id);
    $sql = "SELECT * FROM patrons WHERE `patron_id` = " . $id . " AND `name`='" . $name . "'";
    $sql = "INSERT INTO patrons (`name`, `patron_id`, `email`, `schedule`) VALUES (`" . $name . "`,`" . $id . "`,`" . $email . "`,``)";
} else {
    $result = $conn->query("SELECT chat_content FROM chats WHERE `name` = " . $name . " AND `password` = " . $password);
    echo $result;
}

$conn->close();