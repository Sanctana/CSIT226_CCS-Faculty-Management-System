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
        $sectionId = (int) $row['sectionid'];
        $deleteUrl = "managementsection.php?delete_section_id={$sectionId}";
        $deleteUrlAttr = htmlspecialchars($deleteUrl, ENT_QUOTES, 'UTF-8');
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['sectionname']) . "</td>";
        echo "<td>" . htmlspecialchars($row['yearlevel']) . "</td>";
        echo "<td>" . htmlspecialchars($row['programname']) . "</td>";
        echo "<td>
                <a class='btn-edit' href='registersection.php?sectionid={$sectionId}' style='text-decoration: none;'>Edit</a>
                <span class='action-sep'>|</span>
                <a class='btn-delete js-delete-section' href='{$deleteUrlAttr}' data-delete-url='{$deleteUrlAttr}'>Delete</a>
            </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No sections found.</td></tr>";
}
