<?php
$current_page = basename($_SERVER['PHP_SELF']);

if (!isset($_SESSION['user_id'])) {
    header("location: index.php");
    exit();
}
$isAdmin = $_SESSION['role'] === 'department_head';
?>

<aside class="sidebar">
    <div class="logo-area"><img src="assets/img/ccs_logo.png" alt="CCS Logo" class="logo-img">CCS Hub</div>
    <div class="nav-section">
        <div class="nav-label">Menu</div>
        <a href="dashboard.php"
            class="nav-item <?php if ($current_page == 'dashboard.php') echo 'active'; ?>">
            Dashboard
        </a>

        <?php
        if ($isAdmin) {
            echo '<a href="managementfaculty.php" class="nav-item ' . ($current_page == 'managementfaculty.php' ? 'active' : '') . '">Faculty Management</a>';
            # Add Faculty, Edit Faculty, Delete Faculty, View Faculty
        }
        ?>
    </div>
    <div class="nav-section">
        <div class="nav-label">Curriculum</div>

        <?php
        if ($isAdmin) {
            echo '<a href="managementcourse.php" class="nav-item ' . ($current_page == 'managementcourse.php' ? 'active' : '') . '">Course Management</a>';
            # Add Course, Edit Course, Delete Course, View Course
            echo '<a href="managementsection.php" class="nav-item ' . ($current_page == 'managementsection.php' ? 'active' : '') . '">Section Management</a>';
            # Add Section, Edit, Delete
            echo '<a href="registerload.php" class="nav-item ' . ($current_page == 'registerload.php' ? 'active' : '') . '">Register Load</a>';
        }
        ?>
    </div>
    <div style="margin-top: auto; padding: 24px; border-top: 1px solid var(--border-light);">
        <a href="logout.php"
            class="nav-item <?php if ($current_page == 'logout.php') echo 'active'; ?>"
            style="color: #cf1322;">
            Logout
        </a>
    </div>
</aside>