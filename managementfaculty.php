<?php
include 'connections/connect.php';
require_once 'assets/includes/sidebar.php';

$pageTitle = "Faculty Management";

$user_id = $_SESSION['user_id'] ?? 0;
$limit = 10;
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CCS | Faculty Records</title>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet" href="assets/css/sidebar.css">
<link rel="stylesheet" href="assets/css/topbar.css">
<link rel="stylesheet" href="assets/css/variables.css">
<link rel="stylesheet" href="assets/css/components.css">
<link rel="stylesheet" href="assets/css/formtemplate.css">
<link rel="stylesheet" href="assets/css/managementfaculty.css">

<div class="main-wrapper">
    <?php require_once 'assets/includes/topbar.php'; ?>

    <main class="content-body">
        <div class="container">
            <div class="record-panel">
                <div class="record-header">
                    <div>
                        <div class="record-title">Faculty Management</div>
                        <div class="record-subtitle">Manage and view all faculty members</div>
                    </div>
                    <a href="registerfaculty.php" class="add-btn">+ Add New Faculty</a>
                </div>

                <div class="search-bar">
                    <input type="text" class="search-input" placeholder="Search by name, email, or specialization...">
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Faculty Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Specialization</th>
                            <th>Employment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // join tbluser and tblfaculty to get complete info with pagination

                        $user_id = (int) $user_id;

                        // get total rows for pagination
                        $count_sql = "SELECT COUNT(*) AS total
                                      FROM tbluser u
                                      INNER JOIN tblfaculty f ON u.id = f.id
                                      WHERE u.id != $user_id";
                        $count_result = mysqli_query($connection, $count_sql);
                        $total_rows = 0;
                        if ($count_result) {
                            $count_row = mysqli_fetch_assoc($count_result);
                            $total_rows = (int) $count_row['total'];
                        }
                        $total_pages = ($total_rows > 0) ? ceil($total_rows / $limit) : 1;
                        $offset = ($page - 1) * $limit;

                        // fetch paginated results
                        $sql = "SELECT u.id, u.firstname, u.lastname, u.email, u.contactnumber, u.employeestatus, f.specialization
                                FROM tbluser u
                                INNER JOIN tblfaculty f ON u.id = f.id
                                WHERE u.id != $user_id
                                ORDER BY u.lastname, u.firstname
                                LIMIT $limit OFFSET $offset";
                        $result = mysqli_query($connection, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tr>
                                    <td><?php echo $row['firstname'] . " " . $row['lastname']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['contactnumber']; ?></td>
                                    <td><?php echo $row['specialization']; ?></td>
                                    <td><?php echo $row['employeestatus']; ?></td>
                                    <td>
                                        <a href="#"
                                            class="btn-delete"
                                            onclick="if(confirm('Are you sure you want to delete this faculty record?')) {
                                               window.location.href='managementfaculty.php?delete_id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>';
                                               }">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='6'>No faculty records found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <?php if (isset($total_pages) && $total_pages > 1): ?>
                    <nav class="pagination" aria-label="Faculty pagination">
                        <?php if ($page > 1): ?>
                            <a class="pagination-link" href="managementfaculty.php?page=<?php echo $page - 1; ?>">« Prev</a>
                        <?php endif; ?>

                        <?php
                        $start = max(1, $page - 2);
                        $end = min($total_pages, $page + 2);

                        if ($start > 1) {
                            echo '<a class="pagination-link" href="managementfaculty.php?page=1">1</a>';
                            if ($start > 2) echo '<span class="ellipsis">...</span>';
                        }

                        for ($p = $start; $p <= $end; $p++) {
                            if ($p == $page) {
                                echo '<span class="pagination-link current">' . $p . '</span>';
                            } else {
                                echo '<a class="pagination-link" href="managementfaculty.php?page=' . $p . '">' . $p . '</a>';
                            }
                        }

                        if ($end < $total_pages) {
                            if ($end < $total_pages - 1) echo '<span class="ellipsis">...</span>';
                            echo '<a class="pagination-link" href="managementfaculty.php?page=' . $total_pages . '">' . $total_pages . '</a>';
                        }
                        ?>

                        <?php if ($page < $total_pages): ?>
                            <a class="pagination-link" href="managementfaculty.php?page=<?php echo $page + 1; ?>">Next »</a>
                        <?php endif; ?>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </main>
</div>


<?php

if (isset($_GET['delete_id'])) {
    $delete_id = (int) $_GET['delete_id'];
    $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    if ($delete_id > 0) {
        mysqli_query($connection, "DELETE FROM tblfaculty WHERE id = $delete_id");
        mysqli_query($connection, "DELETE FROM tbluser WHERE id = $delete_id");
    }

    echo "<script>window.location.href='managementfaculty.php?page=" . $current_page . "';</script>";
    exit();
}
?>