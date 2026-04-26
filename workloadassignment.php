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


            <div class="dashboard-grid">

                <!-- left panel (faculty workload table) -->
                <div class="record-panel">

                    <div class="record-header">
                        <div>
                            <h3 class="record-title">Faculty Workload Summary</h3>
                            <p class="record-subtitle">Monitor total teaching loads per faculty</p>
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
                            <td><a class="btn-delete">Delete</a></td>
                        </tr>

                        <tr>
                            <td>Mattheus Contreras</td>
                            <td>4 courses</td>
                            <td>12 units</td>
                            <td><span class="badge badge-normal">NORMAL</span></td>
                            <td><a class="btn-delete">Delete</a></td>
                        </tr>

                        <tr>
                            <td>Anna Cruz</td>
                            <td>5 courses</td>
                            <td>15 units</td>
                            <td><span class="badge badge-normal">NORMAL</span></td>
                            <td><a class="btn-delete">Delete</a></td>
                        </tr>

                        </tbody>
                    </table>

                </div>

                <!-- right panel (statistics) -->
                <div class="record-panel">

                    <div class="panel-header">
                        <div class="panel-title" style="font-size: 25px;">Workload Statistics</div>
                    </div>

                    <div class="stats-wrap">


                        <div class="stat-box" style="margin-top: -25px;">
                            <div class="stat-title">Total Faculty</div>
                            <div class="stat-value" style="color:#f47b20;">12</div>
                            <div class="stat-sub">Active faculty members</div>
                        </div>


                        <div class="stat-box" style="background: #ddfae9;">
                            <div class="stat-title">Normal Load</div>
                            <div class="stat-value" style="color:#166534;">10</div>
                            <div class="stat-sub">Within safe workload range</div>
                        </div>


                        <div class="stat-box" style="background: #f6e1e1;">
                            <div class="stat-title">Overloaded</div>
                            <div class="stat-value" style="color:#991b1b;">2</div>
                            <div class="stat-sub">Exceeding maximum units</div>
                        </div>

                    </div>

                </div>

            </div>

            <!-- recent assignments section -->
            <div class="record-panel">

                <div class="record-header">
                    <div>
                        <h3 class="record-title">Recent Workload Assignments</h3>
                        <p class="record-subtitle">Latest course assignments and updates</p>
                    </div>
                </div>

                <table class="data-table">
                    <thead>
                    <tr>
                        <th>Faculty</th>
                        <th>Course Code</th>
                        <th>Section</th>
                        <th>Schedule</th>
                        <th>Units</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>


                    <tr>
                        <td>Leah Barbaso</td>
                        <td>CSIT226</td>
                        <td>G1</td>
                        <td>
                            <small>
                                Tue: 06:30PM - 08:30PM | RTL304<br>
                                Fri: 06:00PM - 09:00PM | NGE207
                            </small>
                        </td>
                        <td>3</td>
                        <td>
                            <a href="registerload.php" class="btn-edit" style="text-decoration: none;">Edit</a>
                            <span class="action-sep"> | </span>
                            <a class="btn-delete">Delete</a>
                        </td>
                    </tr>

                    <tr>
                        <td>Mattheus Contreras</td>
                        <td>IT202</td>
                        <td>G2</td>
                        <td>
                            <small>
                                Tue: 10:00AM - 12:00PM | RTL302<br>
                                Thu: 01:00PM - 03:00PM | NGE202
                            </small>
                        </td>
                        <td>4</td>
                        <td>
                            <a href="registerload.php" class="btn-edit" style="text-decoration: none;">Edit</a>
                            <span class="action-sep"> | </span>
                            <a class="btn-delete">Delete</a>
                        </td>
                    </tr>

                    <tr>
                        <td>Anna Cruz</td>
                        <td>IT101</td>
                        <td>G3</td>
                        <td>
                            <small>
                                Mon: 08:00AM - 10:00AM | RTL301<br>
                                Wed: 02:00PM - 04:00PM | NGE201
                            </small>
                        </td>
                        <td>3</td>
                        <td>
                            <a href="registerload.php" class="btn-edit" style="text-decoration: none;">Edit</a>
                            <span class="action-sep"> | </span>
                            <a class="btn-delete">Delete</a>
                        </td>
                    </tr>

                    </tbody>
                </table>

            </div>

        </div>
    </main>

</div>