<?php
    include 'connections/connect.php';
    require_once 'assets/includes/sidebar.php';

    $pageTitle = "Dashboard";
?>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>CCS | Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/variables.css">
    <link rel="stylesheet" href="/assets/css/dashboard.css">
    <link rel="stylesheet" href="/assets/css/components.css">

    <script src="assets/js/dashboard.js"></script>


<div class="main-wrapper">
    <?php  require_once 'assets/includes/topbar.php'; ?>
    <!-- body content -->
    <main class="content-body">
        <div class="container">

            <div class="welcome-flex">
                <div class="welcome-text">
                    <h1>Welcome Back, <span>Sta. Romana!</span></h1>
                    <p>Here is what's happening in your department today.</p>
                </div>
                <div class="quick-actions">
                    <div class="quick-actions">
                        <a href="registerfaculty.php" class="action-btn btn-primary" style="text-decoration: none;">+ Add New Faculty</a>
                        <a href="registerload.php" class="action-btn btn-primary" style="text-decoration: none;">+ Assign New Load</a>
                    </div>
                </div>
            </div>

            <!-- stats soft gradient -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">Faculty Composition</div>
                    <div class="stat-value">32</div>

                    <div class="stat-bottom">
                        <div class="comp-pill">
                            <span class="tag tag-o">2 Dept. Heads</span>
                            <span class="tag tag-b">30 Faculty</span>
                        </div>
                        <a href="managementfaculty.php" class="view-btn" style="text-decoration: none;">View</a>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-label">Total Courses</div>
                    <div class="stat-value">34</div>

                    <div class="stat-bottom">
                        <p class="stat-desc" style="color:#16a34a;">2 New Courses Added</p>
                        <a href="managementcourse.php" class="view-btn" style="text-decoration: none;">View</a>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-label">Total Sections</div>
                    <div class="stat-value">51</div>

                    <div class="stat-bottom">
                        <p class="stat-desc">Across 4 Year Levels</p>
                        <a href="managementsection.php" class="view-btn" style="text-decoration: none;">View</a>
                    </div>
                </div>
            </div>

            <!-- main grid - montoring -->
            <div class="dashboard-main">
                <div class="panel">
                    <div class="panel-h">
                        <span class="panel-t">Workload Monitoring</span>
                    </div>
                    <table>
                        <thead>
                        <tr><th>Faculty</th><th>Units</th><th>Status</th></tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Leah Barbaso</td>
                            <td>22.0</td>
                            <td>
                    <span class="pill pill-r">
                        <span class="status-dot red"></span> Overload
                    </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Kenn Gumonan</td>
                            <td>24.0</td>
                            <td>
                    <span class="pill pill-r">
                        <span class="status-dot red"></span> Overload
                    </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Jasmine Tulin</td>
                            <td>18.0</td>
                            <td>
                    <span class="pill pill-g">
                        <span class="status-dot green"></span> Normal
                    </span>
                            </td>
                        </tr>
                        <tr>
                            <td>James Acabal</td>
                            <td>18.0</td>
                            <td>
                    <span class="pill pill-g">
                        <span class="status-dot green"></span> Normal
                    </span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="panel">
                    <span class="panel-t">Faculty Breakdown</span>
                    <div style="margin-top: 24px;">
                        <div class="prog-item">
                            <div class="prog-info"><span>Full-Time</span><span>25</span></div>
                            <div class="prog-bg"><div class="prog-bar" style="width: 80%;"></div></div>
                        </div>
                        <div class="prog-item">
                            <div class="prog-info"><span>Part-Time</span><span>7</span></div>
                            <div class="prog-bg"><div class="prog-bar" style="width: 25%; opacity: 0.6;"></div></div>
                        </div>
                    </div>
                    <div class="alert-box">
                        <span style="font-size: 12px; font-weight: 800; color: var(--primary);">SYSTEM ALERT</span>
                        <span style="font-size: 13px; font-weight: 600;">Semester workload report is ready for review.</span>
                        <button class="alert-btn">Generate Report</button>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-h"><span id="mon" style="font-size: 14px; font-weight: 800;"></span></div>
                    <div class="cal" id="cal"></div>
                </div>
            </div>
        </div>
    </main>
</div>
