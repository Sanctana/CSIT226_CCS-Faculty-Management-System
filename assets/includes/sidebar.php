<?php
// Get current page filename
$current_page = basename($_SERVER['PHP_SELF']);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCS | Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/sidebar.css">
</head>

<aside class="sidebar">
    <div class="logo-area"><img src="assets/img/ccs_logo.png" alt="CCS Logo" class="logo-img">CCS Hub</div>
    <div class="nav-section">
        <div class="nav-label">Menu</div>
        <a href="dashboard.php"
           class="nav-item <?php if($current_page == 'dashboard.php') echo 'active'; ?>">
            Dashboard
        </a>
        <a href="managementfaculty.php"
           class="nav-item <?php if($current_page == 'managementfaculty.php') echo 'active'; ?>">
            Faculty Management
        </a>
<!--        Add Faculty, Edit Faculty, Delete Faculty, View Faculty-->
        <a href="workloadassignment.php"
           class="nav-item <?php if($current_page == 'workloadassignment.php') echo 'active'; ?>">
            Workload Assignment
        </a>
<!--        Assign faculty -> coursae -> section -> schedule-->
<!--        View teaching load-->
<!--        Detect overload-->
    </div>
    <div class="nav-section">
        <div class="nav-label">Curriculum</div>
        <a href="managementcourse.php"
           class="nav-item <?php if($current_page == 'managementcourse.php') echo 'active'; ?>">
            Course Management
        </a>
<!--        Add Course, Edit Course, Delete Course, View Course-->
        <a href="managementsection.php"
           class="nav-item <?php if($current_page == 'managementsection.php') echo 'active'; ?>">
            Section Management
        </a>
<!--        Add Section, Edit, Delete -->
        <a href="managementschedule.php"
           class="nav-item <?php if($current_page == 'managementschedule.php') echo 'active'; ?>">
            Schedule Management
        </a>

        <!--        Add Schedule (Day, Time, Room), Edit, Delete-->
    </div>
    <div style="margin-top: auto; padding: 24px; border-top: 1px solid var(--border-light);">
        <a href="logout.php"
           class="nav-item <?php if($current_page == 'logout.php') echo 'active'; ?>"
           style="color: #cf1322;">
            Logout
        </a>
    </div>
</aside>



