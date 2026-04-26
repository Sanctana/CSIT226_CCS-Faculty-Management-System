<?php
    include 'connections/connect.php';
    require_once 'assets/includes/sidebar.php';

    $pageTitle = "Register Section";
?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CCS | Section Registration</title>


    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/sidebar.css">
    <link rel="stylesheet" href="assets/css/topbar.css">
    <link rel="stylesheet" href="assets/css/variables.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <link rel="stylesheet" href="assets/css/formtemplate.css">

<div class="main-wrapper">

    <?php  require_once 'assets/includes/topbar.php'; ?>

    <main class="content-body">
        <div class="container">
            <div class="form-panel">
                <div class="form-header">
                    <a href="managementsection.php" class="back-icon">
                        <img src="assets/img/back.png" alt="Back">
                    </a>
                    <h2>Section Registration</h2>

                </div>

                <div class="form-divider"></div>

                <form method="post">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Section Name</label>
                            <input type="text" name="sectionname" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Year Level</label>
                            <select name="yearlevel" class="form-select" required>
                                <option value="">Select Year Level</option>
                                <option value="1">1st Year</option>
                                <option value="2">2nd Year</option>
                                <option value="3">3rd Year</option>
                                <option value="4">4th Year</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Program</label>
                            <select name="program" class="form-select" required>
                                <option value="">Select Program</option>
                                <option value="CS">BSCS</option>
                                <option value="IT">BSIT</option>
                            </select>
                        </div>
                    </div>

                    <input type="submit" name="btnRegister" value="Register Section" class="form-submit">
                </form>
            </div>
        </div>
    </main>

</div>