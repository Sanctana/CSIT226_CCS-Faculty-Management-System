<?php
    include 'connections/connect.php';
    require_once 'assets/includes/sidebar.php';

    $pageTitle = "Section Management";
?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CCS | Section Management</title>


    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/sidebar.css">
    <link rel="stylesheet" href="assets/css/topbar.css">
    <link rel="stylesheet" href="assets/css/variables.css">
    <link rel="stylesheet" href="assets/css/components.css">



<div class="main-wrapper">
    <!-- top bar -->
    <?php  require_once 'assets/includes/topbar.php'; ?>
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
                    <input type="text" class="search-input" placeholder="Search by section name or year level...">
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

                </table>
            </div>
        </div>
    </main>
</div>