<?php
$db_config = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . "/../private/db_config.ini");

$conn = new mysqli($db_config["servername"], $db_config["username"], $db_config["password"], $db_config["dbname"]);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset('utf8mb4');

$idlist = $_POST["idlist"];
$lastedited = $_POST["lastedited"];

$sql = "SELECT * FROM list WHERE idlist = '$idlist'";
$result = mysqli_fetch_assoc($conn->query($sql));

if ($conn->error) {
    echo ("Error: $conn->errno - $conn->error");
} else {
    if ($result["lastedited"] != $lastedited) {
        echo json_encode($result);
    } else {
        echo false;
    }
}
?>