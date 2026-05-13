<?php
require_once '../connections/connect.php';

$year = isset($_GET['year']) ? intval($_GET['year']) : 0;

$response = [];

if ($year > 0) {
    $sql = "SELECT coursecodeid, coursecode, coursetitle FROM tblcourse WHERE year_level = $year ORDER BY coursecode";
} else {
    $sql = "SELECT coursecodeid, coursecode, coursetitle FROM tblcourse ORDER BY coursecode";
}

$result = $connection->query($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $response[] = [
            'id' => (int)$row['coursecodeid'],
            'text' => $row['coursecode'] . ' - ' . $row['coursetitle']
        ];
    }
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);
