<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCS | Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/dashboard.css">
    <script src="assets/js/dashboard.js"></script>
</head>
<body>

<!-- my sidebar <3 -->
<aside class="sidebar">
    <div class="logo-area"><img src="assets/img/ccs_logo.png" alt="FWMS Logo" class="logo-img">CCS AcadHub</div>
    <div class="nav-section">
        <div class="nav-label">Menu</div>
        <a href="#" class="nav-item active">Dashboard</a>
        <a href="#" class="nav-item">Faculty Members</a>
        <a href="#" class="nav-item">Workload Assignment</a>
    </div>
    <div class="nav-section">
        <div class="nav-label">Curriculum</div>
        <a href="#" class="nav-item">Course Catalog</a>
        <a href="#" class="nav-item">Schedules</a>
    </div>
    <div style="margin-top: auto; padding: 24px; border-top: 1px solid var(--border-light);">
        <a href="#" class="nav-item" style="color: #cf1322;">Logout</a>
    </div>
</aside>

<div class="main-wrapper">
    <!-- top bar -->
    <header class="top-bar">
        <div class="breadcrumb">Academic Management / <span>Dashboard</span></div>
        <div class="header-right-group">
            <div class="semester-pill"><div class="live-dot"></div>2nd Semester, AY 2023-2024</div>
            <div class="profile-trigger">
                <div class="user-text">
                    <span class="user-name">Cherry Lyn Sta. Romana</span>
                    <span class="user-role">CS Department Head</span>
                </div>
                <div class="avatar" style="background: url('https://ui-avatars.com/api/?name=Cherry+Sta+Romana&background=f47b20&color=fff'); background-size: cover;"></div>
            </div>
        </div>
    </header>

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
                        <a href="registerfaculty.php" class="action-btn btn-primary">+ Add New Faculty</a>
                        <a href="registerload.php" class="action-btn btn-primary">+ Assign New Load</a>
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
                        <button class="view-btn">View</button>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-label">Total Courses</div>
                    <div class="stat-value">34</div>

                    <div class="stat-bottom">
                        <p class="stat-desc" style="color:#16a34a;">2 New Courses Added</p>
                        <button class="view-btn">View</button>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-label">Total Sections</div>
                    <div class="stat-value">51</div>

                    <div class="stat-bottom">
                        <p class="stat-desc">Across 4 Year Levels</p>
                        <button class="view-btn">View</button>
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
</body>
</html>