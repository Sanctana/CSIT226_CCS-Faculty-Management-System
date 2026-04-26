<?php
// altair's work here
    include 'connections/connect.php';
    require_once 'assets/includes/sidebar.php';

    $pageTitle = "Workload Assignment";
?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CCS | Workload Assignment</title>


    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/sidebar.css">
    <link rel="stylesheet" href="assets/css/topbar.css">
    <link rel="stylesheet" href="assets/css/variables.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <link rel="stylesheet" href="assets/css/formtemplate.css">

<div class="main-wrapper">

    <?php require_once 'assets/includes/topbar.php'; ?>

    <main class="content-body">
        <div class="container">

            <div class="form-panel">
                <div class="form-header">
                    <a href="workloadassignment.php" class="back-icon">
                        <img src="assets/img/back.png" alt="Back">
                    </a>
                    <h2>Workload Assignment</h2>
                </div>

                <div class="form-divider"></div>

                <form method="post">

                    <div class="form-grid">


                        <div class="form-group">
                            <label class="form-label">Teacher</label>
                            <select name="teacher" class="form-select" required>
                                <option value="">Select Teacher</option>
                                <option value="1">Kenn Migan Vincent Gumonan</option>
                                <option value="2">Leah Barbaso</option>
                                <option value="3">Fredrick Revilleza</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Year Level</label>
                            <select name="year_level" class="form-select" required>
                                <option value="">Select Year Level</option>
                                <option value="1">1st Year</option>
                                <option value="2">2nd Year</option>
                                <option value="3">3rd Year</option>
                                <option value="4">4th Year</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label class="form-label">Semester</label>
                            <select name="semester" class="form-select" required>
                                <option value="">Select Semester</option>
                                <option value="1st">1st Semester</option>
                                <option value="2nd">2nd Semester</option>
                                <option value="summer">Summer</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label class="form-label">School Year</label>
                            <input type="text" name="school_year" class="form-input" placeholder="e.g. 2025-2026" required>
                        </div>


                        <div class="form-group">
                            <label class="form-label">Section</label>
                            <select name="section" class="form-select" required>
                                <option value="">Select Section</option>
                                <option value="G1">G1</option>
                                <option value="G2">G2</option>
                                <option value="G3">G3</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Course Code</label>
                            <select name="course_code" class="form-select" required>
                                <option value="">Select Course</option>
                                <option value="IT101">CSIT238 - Platform-based Development Mobile</option>
                                <option value="IT102">CSIT228 - Object-Oriented Programming</option>
                                <option value="CS201">CSIT212 - Quantitative Methods</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Schedule</label>
                            <select name="schedule" class="form-select" required>
                                <option value="">Select Schedule</option>

                                <option value="tue-0630-0830-rtl304-nge207">
                                    C
                                </option>

                                <option value="mon-0800-1000-r201-nge207">
                                    Mon: 08:00AM - 10:00AM | RTL302, Fri: 08:00PM - 10:30PM NGE203
                                </option>

                            </select>
                        </div>

                    </div>

                    <input type="submit" name="btnAssign" value="Assign Workload" class="form-submit">

                </form>
            </div>

        </div>
    </main>

</div>