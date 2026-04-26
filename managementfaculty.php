<?php
    include 'connections/connect.php';
    require_once 'assets/includes/sidebar.php';

    $pageTitle = "Faculty Management";
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

<div class="main-wrapper">
    <?php  require_once 'assets/includes/topbar.php'; ?>

    <!-- body content -->
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

                <table class="faculty-table">
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

                </table>
            </div>
        </div>
    </main>
</div>
