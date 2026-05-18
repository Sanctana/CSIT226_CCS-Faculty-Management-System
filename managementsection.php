<?php
include 'connections/connect.php';
require_once 'assets/includes/sidebar.php';

$pageTitle = "Section Management";

$limit = 10;
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;

// get total rows for pagination
$count_sql = "SELECT COUNT(*) AS total FROM tblsection";
$count_result = mysqli_query($connection, $count_sql);
$total_rows = 0;
if ($count_result) {
    $count_row = mysqli_fetch_assoc($count_result);
    $total_rows = (int) $count_row['total'];
}
$total_pages = ($total_rows > 0) ? ceil($total_rows / $limit) : 1;
$offset = ($page - 1) * $limit;
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CCS | Section Management</title>


<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet" href="assets/css/sidebar.css">
<link rel="stylesheet" href="assets/css/topbar.css">
<link rel="stylesheet" href="assets/css/variables.css">
<link rel="stylesheet" href="assets/css/components.css">
<link rel="stylesheet" href="assets/css/managementfaculty.css">
<link rel="stylesheet" href="assets/css/managementsection.css">



<div class="main-wrapper">
    <!-- top bar -->
    <?php require_once 'assets/includes/topbar.php'; ?>
    <!-- body content -->
    <main class="content-body">
        <div class="container">
            <div class="record-panel">
                <div class="record-header">
                    <div>
                        <div class="record-title">Section Management</div>
                        <div class="record-subtitle">Manage and view all sections</div>
                    </div>
                    <a href="registersection.php" class="add-btn">+ Add Section</a>
                </div>

                <div class="search-bar">
                    <input type="text" class="search-input" id="section-search" placeholder="Search by section name or year level...">
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Section Name</th>
                            <th>Year Level</th>
                            <th>Program</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody id="section-table-body">
                        <?php
                        $sql = "SELECT s.sectionname, s.yearlevel, p.programname, s.sectionid
                                FROM tblsection s
                                JOIN tblprogram p ON s.programid = p.programid
                                ORDER BY s.sectionname
                                LIMIT $limit OFFSET $offset";
                        $result = mysqli_query($connection, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $sectionId = (int) $row['sectionid'];
                                $deleteUrl = "managementsection.php?delete_section_id={$sectionId}&page={$page}";
                                $deleteUrlAttr = htmlspecialchars($deleteUrl, ENT_QUOTES, 'UTF-8');

                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($row['sectionname']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['yearlevel']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['programname']) . '</td>';
                                echo '<td>
                                        <a class="btn-edit" href="registersection.php?sectionid=' . $sectionId . '" style="text-decoration: none;">Edit</a>
                                        <span class="action-sep">|</span>
                                        <a class="btn-delete js-delete-section" href="' . $deleteUrlAttr . '" data-delete-url="' . $deleteUrlAttr . '">Delete</a>
                                      </td>';
                                echo '</tr>';
                            }
                        } else {
                            echo "<tr><td colspan='4'>No sections found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <?php if (isset($total_pages) && $total_pages > 1): ?>
                    <nav class="pagination" aria-label="Section pagination">
                        <?php if ($page > 1): ?>
                            <a class="pagination-link" href="managementsection.php?page=<?php echo $page - 1; ?>">« Prev</a>
                        <?php endif; ?>

                        <?php
                        $start = max(1, $page - 2);
                        $end = min($total_pages, $page + 2);

                        if ($start > 1) {
                            echo '<a class="pagination-link" href="managementsection.php?page=1">1</a>';
                            if ($start > 2) echo '<span class="ellipsis">...</span>';
                        }

                        for ($p = $start; $p <= $end; $p++) {
                            if ($p == $page) {
                                echo '<span class="pagination-link current">' . $p . '</span>';
                            } else {
                                echo '<a class="pagination-link" href="managementsection.php?page=' . $p . '">' . $p . '</a>';
                            }
                        }

                        if ($end < $total_pages) {
                            if ($end < $total_pages - 1) echo '<span class="ellipsis">...</span>';
                            echo '<a class="pagination-link" href="managementsection.php?page=' . $total_pages . '">' . $total_pages . '</a>';
                        }
                        ?>

                        <?php if ($page < $total_pages): ?>
                            <a class="pagination-link" href="managementsection.php?page=<?php echo $page + 1; ?>">Next »</a>
                        <?php endif; ?>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </main>
</div>

<div class="modal-backdrop" id="delete-section-modal" aria-hidden="true" hidden>
    <div class="modal" role="dialog" aria-modal="true" aria-labelledby="delete-section-title" aria-describedby="delete-section-desc">
        <h3 id="delete-section-title">Delete section?</h3>
        <p id="delete-section-desc">This action removes the section and cannot be undone.</p>
        <div class="modal-actions">
            <button type="button" class="btn-cancel" data-modal-cancel>Cancel</button>
            <a href="#" class="btn-confirm" data-modal-confirm>Yes, delete</a>
        </div>
    </div>
</div>

<script src="assets/js/managementsection.js"></script>
<?php
if (isset($_GET['delete_section_id']) && ctype_digit($_GET['delete_section_id'])) {
    $sectionId = (int) $_GET['delete_section_id'];
    $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

    $deleteStmt = $connection->prepare("DELETE FROM tblsection WHERE sectionid = ?");
    if ($deleteStmt) {
        $deleteStmt->bind_param("i", $sectionId);
        $deleteStmt->execute();
        $deleteStmt->close();
    }

    echo "<script>window.location.href='managementsection.php?page=" . $current_page . "';</script>";
    exit();
}
?>