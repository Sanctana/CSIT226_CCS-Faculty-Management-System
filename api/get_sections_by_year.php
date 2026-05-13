<?php
require_once '../connections/connect.php';

$year = isset($_GET['year']) ? intval($_GET['year']) : 0;

$response = [];

if ($year > 0) {
    $sql = "SELECT s.sectionid, s.sectionname, p.programname FROM tblsection s JOIN tblprogram p ON s.programid = p.programid WHERE s.yearlevel = $year ORDER BY s.sectionname";
} else {
    $sql = "SELECT s.sectionid, s.sectionname, p.programname FROM tblsection s JOIN tblprogram p ON s.programid = p.programid ORDER BY s.sectionname";
}

$result = $connection->query($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $response[] = [
            'id' => (int)$row['sectionid'],
            'text' => $row['sectionname'] . ' (' . $row['programname'] . ')'
        ];
    }
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);
