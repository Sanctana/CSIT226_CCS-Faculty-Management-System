<?php
include 'connections/connect.php';
require_once 'assets/includes/sidebar.php';

$pageTitle = "Course Management";
?>


<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CCS | Course Management</title>


<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet" href="assets/css/sidebar.css">
<link rel="stylesheet" href="assets/css/topbar.css">
<link rel="stylesheet" href="assets/css/variables.css">
<link rel="stylesheet" href="assets/css/components.css">
<link rel="stylesheet" href="assets/css/formtemplate.css">



<div class="main-wrapper">
    <?php require_once 'assets/includes/topbar.php'; ?>
    <!-- body content -->
    <main class="content-body">
        <div class="container">
            <div class="record-panel">
                <div class="record-header">
                    <div>
                        <div class="record-title">Course Management</div>
                        <div class="record-subtitle">Manage and view all courses</div>
                    </div>
                    <a href="registercourse.php" class="add-btn">+ Add Course</a>
                </div>

                <div class="search-bar">
                    <input type="text" class="search-input" placeholder="Search by course code or title...">
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Course Code</th>
                            <th>Course Title</th>
                            <th>Units</th>
                            <th>Year Level</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <?php
                    $sql = "SELECT * FROM tblcourse";
                    $result = $connection->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['coursecode'] . "</td>";
                            echo "<td>" . $row['coursetitle'] . "</td>";
                            echo "<td>" . $row['units'] . "</td>";
                            echo "<td>" . $row['year_level'] . "</td>";
                            echo "<td>
                                    <a href='editcourse.php?id=" . $row['coursecodeid'] . "' class='edit-btn'>Edit</a>
                                    <a href='deletecourse.php?id=" . $row['coursecodeid'] . "' class='delete-btn'>Delete</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No courses found.</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </main>
</div>