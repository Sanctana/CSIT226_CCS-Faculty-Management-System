<?php
include 'connections/connect.php';
$pageTitle = "Dashboard";
?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCS | Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/variables.css">
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <link rel="stylesheet" href="assets/css/topbar.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">

    <script src="assets/js/dashboard.js" defer></script>

<?php require_once 'assets/includes/sidebar.php'; ?>

<div class="main-wrapper">
    <?php require_once 'assets/includes/topbar.php'; ?>

    <main class="content-body">
        <div class="container">

            <!-- Welcome Section -->
            <div class="welcome-text">
                <h1>Welcome Back, <span>Admin!</span></h1>
                <p>Here are your quick actions for managing the department.</p>
            </div>

            <br>
            <!-- Quick Actions Section -->
            <div class="quick-actions">
                <a href="registercourse.php" class="add-btn">+ Add New Course</a>
                <a href="registerfaculty.php" class="add-btn">+ Add New Faculty</a>
                <a href="registerload.php" class="add-btn">+ Add New Load</a>
                <a href="registerschedule.php" class="add-btn">+ Add Schedule & Section</a>
                <a href="workloadassignment.php" class="add-btn">+ Assign Workload</a>
            </div>

        </div>
    </main>
</div>