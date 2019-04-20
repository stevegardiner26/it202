<?php
/**
 * Created by PhpStorm.
 * User: stevegardiner
 * Date: 2019-04-19
 * Time: 18:04
 */

$type = $_GET['type'];
$nameP = $_GET['name'];
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
    /*$result = $conn->query("SELECT * FROM chats WHERE `name` = " . $nameP . " AND `password` = " . $password);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {*/
    if($conn->query("UPDATE chats SET `chat_content` = '". $content ."' WHERE `name`='" . $nameP . "' AND `password`='" . $password . "'")) {
        $result4 = 'Success';
    } else {
        $result4 = 'Error: ' . $conn->error;
    }
      /*  }
    } else {
        $result4 = $conn->query("INSERT INTO chats (`name`, `password`, `chat_content`) VALUES (`" . $nameP . "`,`" . $password . "`,`" . $content . "`)");
    }*/
} else if ($type == 'read'){
    $result = $conn->prepare("SELECT chat_content FROM chats WHERE `name` = ?");
    $result->bind_param("s", $nameP);
    $result->execute();
    $result->store_result();
    $result->bind_result($cont);
    $result->fetch();
    $result->close();
    $result4 = $cont;
} else if ($type == 'name') {
    $result = $conn->query("SELECT `name` FROM chats");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $result4 .= (" " . $row['name']);
        }
    }
}

echo $result4;

$conn->close();