<?php
    include 'connections/connect.php';
    require_once 'assets/includes/sidebar.php';

    $pageTitle = "Register Schedule";
?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CCS | Register Schedule</title>

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
        <a href="managementsection.php" class="back-icon">
            <img src="assets/img/back.png" alt="Back">
        </a>
        <h2>Register Schedule</h2>
        <span class="spacer"></span>
    </div>

    <div class="form-divider"></div>

    <form method="post">

        <div class="form-grid">


            <div class="form-group">
                <label class="form-label">Day of Week</label>
                <select name="dayOfWeek" class="form-select" required>
                    <option value="">Select Day</option>
                    <option>Monday</option>
                    <option>Tuesday</option>
                    <option>Wednesday</option>
                    <option>Thursday</option>
                    <option>Friday</option>
                    <option>Saturday</option>
                </select>
            </div>


            <div class="form-group">
                <label class="form-label">Room Type</label>
                <select name="roomType" class="form-select" required>
                    <option value="">Select Type</option>
                    <option>Lecture</option>
                    <option>Laboratory</option>
                </select>
            </div>


            <div class="form-group">
                <label class="form-label">Start Time</label>
                <input type="time" name="startTime" class="form-input" required>
            </div>


            <div class="form-group">
                <label class="form-label">End Time</label>
                <input type="time" name="endTime" class="form-input" required>
            </div>


            <div class="form-group">
                <label class="form-label">Building</label>
                <input type="text" name="building" class="form-input" placeholder="e.g. RTL, NGE" required>
            </div>


            <div class="form-group">
                <label class="form-label">Room Number</label>
                <input type="text" name="roomNumber" class="form-input" placeholder="e.g. 304" required>
            </div>

        </div>


        <input type="submit" name="btnSave" value="Save Schedule" class="form-submit">

    </form>

</div>

</div>
</main>

</div>