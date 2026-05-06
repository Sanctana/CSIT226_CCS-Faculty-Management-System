<?php
include 'connections/connect.php';
require_once 'assets/includes/sidebar.php';

$pageTitle = "Schedule Management";
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CCS | Schedule Management</title>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet" href="assets/css/sidebar.css">
<link rel="stylesheet" href="assets/css/topbar.css">
<link rel="stylesheet" href="assets/css/variables.css">
<link rel="stylesheet" href="assets/css/components.css">

<div class="main-wrapper">

    <?php require_once 'assets/includes/topbar.php'; ?>

    <main class="content-body">
        <div class="container">

            <div class="record-panel">

                <!-- header -->
                <div class="record-header">
                    <div>
                        <div class="record-title">Schedule Management</div>
                        <div class="record-subtitle">Create and manage available schedules before assigning to faculty</div>
                    </div>

                    <a href="registerschedule.php" class="add-btn">+ Create Schedule</a>
                </div>

                <!-- search -->
                <div class="search-bar">
                    <input type="text" class="search-input" placeholder="Search by day, room, or building...">
                </div>

                <!-- schedule table -->
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Time</th>
                            <th>Room Type</th>
                            <th>Building</th>
                            <th>Room</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <!-- sample row -->
                        <tr>
                            <td>Monday</td>
                            <td>07:30 AM - 10:30 AM</td>
                            <td>Laboratory</td>
                            <td>RTL</td>
                            <td>304</td>
                            <td>
                                <a href="registerschedule.php" class="btn-edit" style="text-decoration: none;">Edit</a>
                                <span class="action-sep">|</span>
                                <a class="btn-delete">Delete</a>
                            </td>
                        </tr>

                        <tr>
                            <td>Tuesday</td>
                            <td>01:00 PM - 03:00 PM</td>
                            <td>Lecture</td>
                            <td>NGE</td>
                            <td>202</td>
                            <td>
                                <a href="registerschedule.php" class="btn-edit" style="text-decoration: none;">Edit</a>
                                <span class="action-sep">|</span>
                                <a class="btn-delete">Delete</a>
                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>

        </div>
    </main>

</div>


