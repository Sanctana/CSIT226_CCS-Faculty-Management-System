<?php
include 'connections/connect.php';
require "assets/includes/sidebar.php";

$pageTitle = "Workload Assignment";
?>


<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CCS | Workload Assignment</title>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet" href="assets/css/variables.css">
<link rel="stylesheet" href="assets/css/sidebar.css">
<link rel="stylesheet" href="assets/css/topbar.css">
<link rel="stylesheet" href="assets/css/components.css">
<link rel="stylesheet" href="assets/css/formtemplate.css">
<link rel="stylesheet" href="assets/css/workloadassignment.css">

<div class="main-wrapper">

    <?php require "assets/includes/topbar.php"; ?>

    <main class="content-body">
        <div class="container">

            <!-- SAME STYLE AS COURSE MANAGEMENT -->
            <div class="record-panel">

                <div class="record-header">
                    <div>
                        <div class="record-title">Workload Assignment</div>
                        <div class="record-subtitle">Monitor and manage faculty teaching loads</div>
                    </div>

                    <a href="registerload.php" class="add-btn">+ Assign New Load</a>
                </div>

                <table class="data-table">
                    <thead>
                    <tr>
                        <th>Faculty Name</th>
                        <th>Total Courses</th>
                        <th>Total Units</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>

                    <tr>
                        <td>Leah Barbaso</td>
                        <td>7 courses</td>
                        <td>21 units</td>
                        <td><span class="badge badge-overload">OVERLOAD</span></td>
                        <td>
                            <a class="btn-delete">Delete</a>
                        </td>
                    </tr>

                    <tr>
                        <td>Mattheus Contreras</td>
                        <td>4 courses</td>
                        <td>12 units</td>
                        <td><span class="badge badge-normal">NORMAL</span></td>
                        <td>
                            <a class="btn-delete">Delete</a>
                        </td>
                    </tr>

                    <tr>
                        <td>Anna Cruz</td>
                        <td>5 courses</td>
                        <td>15 units</td>
                        <td><span class="badge badge-normal">NORMAL</span></td>
                        <td>
                            <a class="btn-delete">Delete</a>
                        </td>
                    </tr>

                    </tbody>
                </table>

            </div>

        </div>
    </main>

</div>