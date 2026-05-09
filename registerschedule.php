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
                    <input type="hidden" name="form_type" value="register_schedule">
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

<?php

if (isset($_POST['form_type']) && $_POST['form_type'] === 'register_schedule') {
    $dayOfWeek = mysqli_real_escape_string($connection, trim($_POST['dayOfWeek']));
    $roomType = mysqli_real_escape_string($connection, trim($_POST['roomType']));
    $startTime = mysqli_real_escape_string($connection, trim($_POST['startTime']));
    $endTime = mysqli_real_escape_string($connection, trim($_POST['endTime']));
    $building = mysqli_real_escape_string($connection, trim($_POST['building']));
    $roomNumber = mysqli_real_escape_string($connection, trim($_POST['roomNumber']));

    $dayMap = [
        'Monday'    => 'M',
        'Tuesday'   => 'T',
        'Wednesday' => 'W',
        'Thursday'  => 'TH',
        'Friday'    => 'F',
        'Saturday'  => 'SAT',
        'Sunday'    => 'SUN'
    ];

    $dbDay = $dayMap[$dayOfWeek] ?? null;
    if (!$dbDay) {
        die('Invalid day selected.');
    }

    // basic time validation
    if ($startTime >= $endTime) {
        die('Start time must be before end time.');
    }

    // normalize input (optional)
    $building = trim($building);
    $roomNumber = trim($roomNumber);

    // CHECK for overlaps (same day, same building, same room)
    $sqlCheck = "
  SELECT COUNT(*) AS cnt
  FROM tblcourseschedule
  WHERE dayofweek = ?
    AND building = ?
    AND roomnumber = ?
    AND (starttime < ? AND endtime > ?)
";
    $stmt = $connection->prepare($sqlCheck);
    $stmt->bind_param("sssss", $dbDay, $building, $roomNumber, $endTime, $startTime);
    $stmt->execute();
    $stmt->bind_result($cnt);
    $stmt->fetch();
    $stmt->close();

    if ($cnt > 0) {
        die('Conflict detected: that room is already scheduled for the chosen time.');
    }

    // INSERT (ensure you supply a valid assignment id)
    $assignmentId = 0; // <-- replace with the real assignment id if required
    $sqlInsert = "
  INSERT INTO tblcourseschedule
    (dayofweek, starttime, endtime, roomtype, building, roomnumber, assignmentid)
  VALUES (?, ?, ?, ?, ?, ?, ?)
";
    $stmt2 = $connection->prepare($sqlInsert);
    $stmt2->bind_param("ssssssi", $dbDay, $startTime, $endTime, $roomType, $building, $roomNumber, $assignmentId);
    if ($stmt2->execute()) {
        echo 'Schedule saved.';
    } else {
        echo 'Insert failed: ' . $stmt2->error;
    }
    $stmt2->close();
}
