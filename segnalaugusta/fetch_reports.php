<?php
include 'db.php';

$sql = "SELECT * FROM reports";
$result = $conn->query($sql);

$reports = array();
while($row = $result->fetch_assoc()) {
    $reports[] = $row;
}

echo json_encode($reports);
?>
