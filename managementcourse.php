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
<link rel="stylesheet" href="assets/css/managementfaculty.css">
<link rel="stylesheet" href="assets/css/managementcourse.css">

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
                    <input type="text" id="course-search" class="search-input" placeholder="Search by course code or title...">
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

                    <tbody id="course-table-body">
                        <?php
                        // Pagination setup
                        $limit = 10;
                        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;

                        // get total rows for pagination
                        $count_sql = "SELECT COUNT(*) AS total FROM tblcourse";
                        $count_result = $connection->query($count_sql);
                        $total_rows = 0;
                        if ($count_result) {
                            $count_row = $count_result->fetch_assoc();
                            $total_rows = (int) $count_row['total'];
                        }
                        $total_pages = ($total_rows > 0) ? ceil($total_rows / $limit) : 1;
                        $offset = ($page - 1) * $limit;

                        // fetch paginated results
                        $sql = "SELECT * FROM tblcourse ORDER BY coursecode LIMIT $limit OFFSET $offset";
                        $result = $connection->query($sql);

                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['coursecode'] . "</td>";
                                echo "<td>" . $row['coursetitle'] . "</td>";
                                echo "<td>" . $row['units'] . "</td>";
                                echo "<td>" . $row['year_level'] . "</td>";

                                $courseId = (int) $row['coursecodeid'];
                                $deleteUrl = "managementcourse.php?delete_course_id={$courseId}";
                                $deleteUrlAttr = htmlspecialchars($deleteUrl, ENT_QUOTES, 'UTF-8');
                                echo "<td>
                                                                        <a href='registercourse.php?id={$courseId}' class='btn-edit' style='text-decoration: none;'>Edit</a>
                                                                        <span class='action-sep'>|</span>
                                                                        <a href='{$deleteUrlAttr}' class='btn-delete js-delete-course' data-delete-url='{$deleteUrlAttr}'>Delete</a>
                                                                    </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No courses found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <?php if (isset($total_pages) && $total_pages > 1): ?>
                    <nav class="pagination" aria-label="Course pagination">
                        <?php if ($page > 1): ?>
                            <a class="pagination-link" href="managementcourse.php?page=<?php echo $page - 1; ?>">« Prev</a>
                        <?php endif; ?>

                        <?php
                        $start = max(1, $page - 2);
                        $end = min($total_pages, $page + 2);

                        if ($start > 1) {
                            echo '<a class="pagination-link" href="managementcourse.php?page=1">1</a>';
                            if ($start > 2) echo '<span class="ellipsis">...</span>';
                        }

                        for ($p = $start; $p <= $end; $p++) {
                            if ($p == $page) {
                                echo '<span class="pagination-link current">' . $p . '</span>';
                            } else {
                                echo '<a class="pagination-link" href="managementcourse.php?page=' . $p . '">' . $p . '</a>';
                            }
                        }

                        if ($end < $total_pages) {
                            if ($end < $total_pages - 1) echo '<span class="ellipsis">...</span>';
                            echo '<a class="pagination-link" href="managementcourse.php?page=' . $total_pages . '">' . $total_pages . '</a>';
                        }
                        ?>

                        <?php if ($page < $total_pages): ?>
                            <a class="pagination-link" href="managementcourse.php?page=<?php echo $page + 1; ?>">Next »</a>
                        <?php endif; ?>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </main>
</div>

<div class="modal-backdrop" id="delete-course-modal" aria-hidden="true" hidden>
    <div class="modal" role="dialog" aria-modal="true" aria-labelledby="delete-course-title" aria-describedby="delete-course-desc">
        <h3 id="delete-course-title">Delete course?</h3>
        <p id="delete-course-desc">This action removes the course and cannot be undone.</p>
        <div class="modal-actions">
            <button type="button" class="btn-cancel" data-m:qodal-cancel=":q">Cancel</button>
            <a href="#" class="btn-confirm" data-modal-confirm>Yes, delete</a>
        </div>
    </div>
</div>

<script src="assets/js/managementcourse.js"></script>

<?php
if (isset($_GET['delete_course_id']) && ctype_digit($_GET['delete_course_id'])) {
    $courseId = (int) $_GET['delete_course_id'];

    $deleteStmt = $connection->prepare("DELETE FROM tblcourse WHERE coursecodeid = ?");
    $deleteStmt->bind_param("i", $courseId);
    $deleteStmt->execute();
    $deleteStmt->close();

    echo "<script>window.location.href = 'managementcourse.php';</script>";
    exit();
}
?>