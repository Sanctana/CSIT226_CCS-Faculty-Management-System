<?php
require_once '../connections/connect.php';

$q = isset($_GET['q']) ? trim($_GET['q']) : '';

if ($q === '') {
	$sql = "SELECT * FROM tblcourse";
	$result = $connection->query($sql);
} else {
	$like = '%' . $connection->real_escape_string($q) . '%';
	$sql = "SELECT * FROM tblcourse WHERE coursecode LIKE '$like' OR coursetitle LIKE '$like'";
	$result = $connection->query($sql);
}

if ($result && $result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		echo "<tr>";
		echo "<td>" . htmlspecialchars($row['coursecode']) . "</td>";
		echo "<td>" . htmlspecialchars($row['coursetitle']) . "</td>";
		echo "<td>" . htmlspecialchars($row['units']) . "</td>";
		echo "<td>" . htmlspecialchars($row['year_level']) . "</td>";
		// TODO: Add edit and delete links with proper URL encoding
		echo "<td>
							<a href='editcourse.php?id=" . urlencode($row['coursecodeid']) . "' class='edit-btn'>Edit</a>
							<a href='deletecourse.php?id=" . urlencode($row['coursecodeid']) . "' class='delete-btn'>Delete</a>
          </td>";
		echo "</tr>";
	}
} else {
	echo "<tr><td colspan='5'>No courses found.</td></tr>";
}
