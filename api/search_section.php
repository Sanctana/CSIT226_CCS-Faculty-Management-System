<?php
require_once '../connections/connect.php';

$q = isset($_GET['q']) ? trim($_GET['q']) : '';

if ($q === '') {
    $sql = "SELECT s.sectionname, s.yearlevel, p.programname, s.sectionid FROM tblsection s JOIN tblprogram p ON s.programid = p.programid";
    $result = $connection->query($sql);
} else {
    $like = '%' . $connection->real_escape_string($q) . '%';
    $sql = "SELECT s.sectionname, s.yearlevel, p.programname, s.sectionid
            FROM tblsection s
            JOIN tblprogram p ON s.programid = p.programid
            WHERE s.sectionname LIKE '$like' OR s.yearlevel LIKE '$like'";
    $result = $connection->query($sql);
}

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['sectionname']) . "</td>";
        echo "<td>" . htmlspecialchars($row['yearlevel']) . "</td>";
        echo "<td>" . htmlspecialchars($row['programname']) . "</td>";
        // TODO: Add actions for edit and delete with proper links or data attributes
        echo "<td>
                <a class='btn-edit' style='text-decoration: none;'>Edit</a>
                <span class='action-sep'>|</span>
                <a class='btn-delete'>Delete</a>
            </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No courses found.</td></tr>";
}
