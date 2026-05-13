<?php
include 'connections/connect.php';

$pageTitle = "Edit Schedule";
$isAdmin = ($_SESSION['role'] ?? '') === 'department_head';

if (!$isAdmin) {
    header('Location: dashboard.php');
    exit();
}

function fetchSchedule(mysqli $connection, int $scheduleId)
{
    $stmt = $connection->prepare(
        "SELECT 
            cs.scheduleid,
            cs.dayofweek,
            cs.starttime,
            cs.endtime,
            cs.roomtype,
            cs.building,
            cs.roomnumber,
            ta.assignmentid,
            ta.schoolyear,
            ta.section,
            ta.teacherid,
            c.coursetitle,
            c.coursecode,
            u.firstname,
            u.lastname
        FROM tblcourseschedule cs
        JOIN tblteachingassignment ta ON cs.assignmentid = ta.assignmentid
        JOIN tblcourse c ON ta.coursecodeid = c.coursecodeid
        JOIN tblfaculty f ON ta.teacherid = f.id
        JOIN tbluser u ON f.id = u.id
        WHERE cs.scheduleid = ?
        LIMIT 1"
    );

    $stmt->bind_param("i", $scheduleId);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();

    return $data ?: null;
}

$scheduleId = 0;
$errorMessage = '';

if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $scheduleId = (int) $_GET['id'];
}

$schedule = null;
if ($scheduleId > 0) {
    $schedule = fetchSchedule($connection, $scheduleId);
}

if (!$schedule) {
    $errorMessage = 'Schedule not found.';
}

$dayofweek = $schedule['dayofweek'] ?? '';
$starttime = $schedule['starttime'] ?? '';
$endtime = $schedule['endtime'] ?? '';
$roomtype = $schedule['roomtype'] ?? '';
$building = $schedule['building'] ?? '';
$roomnumber = $schedule['roomnumber'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['form_type'] ?? '') === 'schedule_update') {
    $postedId = isset($_POST['schedule_id']) && ctype_digit($_POST['schedule_id']) ? (int) $_POST['schedule_id'] : 0;
    if ($postedId > 0) {
        $scheduleId = $postedId;
    }

    $dayofweek = trim($_POST['dayofweek'] ?? '');
    $starttime = trim($_POST['starttime'] ?? '');
    $endtime = trim($_POST['endtime'] ?? '');
    $roomtype = trim($_POST['roomtype'] ?? '');
    $building = trim($_POST['building'] ?? '');
    $roomnumber = trim($_POST['roomnumber'] ?? '');

    $allowedDays = ['M', 'T', 'W', 'TH', 'F', 'SAT', 'SUN'];
    if ($scheduleId <= 0) {
        $errorMessage = 'Schedule not found.';
    } elseif (!in_array($dayofweek, $allowedDays, true)) {
        $errorMessage = 'Please select a valid day.';
    } elseif ($starttime === '' || $endtime === '') {
        $errorMessage = 'Please enter start and end times.';
    } elseif ($starttime >= $endtime) {
        $errorMessage = 'Start time must be before end time.';
    }

    if ($errorMessage === '') {
        $schedule = fetchSchedule($connection, $scheduleId);
        if (!$schedule) {
            $errorMessage = 'Schedule not found.';
        }
    }

    if ($errorMessage === '') {
        $teacherId = (int) $schedule['teacherid'];
        $sectionName = $schedule['section'];

        if ($roomnumber !== '') {
            $roomStmt = $connection->prepare(
                "SELECT COUNT(*) AS cnt FROM tblcourseschedule WHERE scheduleid <> ? AND dayofweek = ? AND building = ? AND roomnumber = ? AND NOT (endtime <= ? OR starttime >= ?)"
            );
            $roomStmt->bind_param("isssss", $scheduleId, $dayofweek, $building, $roomnumber, $starttime, $endtime);
            $roomStmt->execute();
            $roomCount = (int) ($roomStmt->get_result()->fetch_assoc()['cnt'] ?? 0);
            $roomStmt->close();

            if ($roomCount > 0) {
                $errorMessage = 'Room is already booked for the selected time.';
            }
        }
    }

    if ($errorMessage === '') {
        $teacherStmt = $connection->prepare(
            "SELECT COUNT(*) AS cnt FROM tblcourseschedule s JOIN tblteachingassignment t ON s.assignmentid = t.assignmentid WHERE s.scheduleid <> ? AND s.dayofweek = ? AND NOT (s.endtime <= ? OR s.starttime >= ?) AND t.teacherid = ?"
        );
        $teacherStmt->bind_param("isssi", $scheduleId, $dayofweek, $starttime, $endtime, $teacherId);
        $teacherStmt->execute();
        $teacherCount = (int) ($teacherStmt->get_result()->fetch_assoc()['cnt'] ?? 0);
        $teacherStmt->close();

        if ($teacherCount > 0) {
            $errorMessage = 'Selected faculty already has a class at that time.';
        }
    }

    if ($errorMessage === '') {
        $sectionStmt = $connection->prepare(
            "SELECT COUNT(*) AS cnt FROM tblcourseschedule s JOIN tblteachingassignment t ON s.assignmentid = t.assignmentid WHERE s.scheduleid <> ? AND s.dayofweek = ? AND NOT (s.endtime <= ? OR s.starttime >= ?) AND t.section = ?"
        );
        $sectionStmt->bind_param("issss", $scheduleId, $dayofweek, $starttime, $endtime, $sectionName);
        $sectionStmt->execute();
        $sectionCount = (int) ($sectionStmt->get_result()->fetch_assoc()['cnt'] ?? 0);
        $sectionStmt->close();

        if ($sectionCount > 0) {
            $errorMessage = 'Selected section already has a class at that time.';
        }
    }

    if ($errorMessage === '') {
        $stmt = $connection->prepare(
            "UPDATE tblcourseschedule SET dayofweek = ?, starttime = ?, endtime = ?, roomtype = ?, building = ?, roomnumber = ? WHERE scheduleid = ?"
        );
        $stmt->bind_param("ssssssi", $dayofweek, $starttime, $endtime, $roomtype, $building, $roomnumber, $scheduleId);
        $stmt->execute();
        $stmt->close();

        header('Location: dashboard.php');
        exit();
    }
}

require_once 'assets/includes/sidebar.php';
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CCS | Edit Schedule</title>

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
                    <a href="dashboard.php" class="back-icon">
                        <img src="assets/img/back.png" alt="Back">
                    </a>
                    <h2>Edit Schedule</h2>
                </div>

                <div class="form-divider"></div>

                <?php if ($errorMessage !== ''): ?>
                    <div class="record-subtitle" style="color: #b42318; margin-bottom: 12px;">
                        <?php echo htmlspecialchars($errorMessage); ?>
                    </div>
                <?php endif; ?>

                <?php if ($schedule): ?>
                    <form method="post">
                        <input type="hidden" name="form_type" value="schedule_update">
                        <input type="hidden" name="schedule_id" value="<?php echo (int) $scheduleId; ?>">

                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">Course</label>
                                <input type="text" class="form-input" value="<?php echo htmlspecialchars($schedule['coursecode'] . ' - ' . $schedule['coursetitle']); ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Faculty</label>
                                <input type="text" class="form-input" value="<?php echo htmlspecialchars($schedule['firstname'] . ' ' . $schedule['lastname']); ?>" readonly>
                            </div>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">Section</label>
                                <input type="text" class="form-input" value="<?php echo htmlspecialchars($schedule['section']); ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label class="form-label">School Year</label>
                                <input type="text" class="form-input" value="<?php echo htmlspecialchars($schedule['schoolyear']); ?>" readonly>
                            </div>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">Day</label>
                                <select name="dayofweek" class="form-select" required>
                                    <option value="">Select Day</option>
                                    <option value="M" <?php echo $dayofweek === 'M' ? 'selected' : ''; ?>>M</option>
                                    <option value="T" <?php echo $dayofweek === 'T' ? 'selected' : ''; ?>>T</option>
                                    <option value="W" <?php echo $dayofweek === 'W' ? 'selected' : ''; ?>>W</option>
                                    <option value="TH" <?php echo $dayofweek === 'TH' ? 'selected' : ''; ?>>TH</option>
                                    <option value="F" <?php echo $dayofweek === 'F' ? 'selected' : ''; ?>>F</option>
                                    <option value="SAT" <?php echo $dayofweek === 'SAT' ? 'selected' : ''; ?>>SAT</option>
                                    <option value="SUN" <?php echo $dayofweek === 'SUN' ? 'selected' : ''; ?>>SUN</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Room Type</label>
                                <input type="text" name="roomtype" class="form-input" value="<?php echo htmlspecialchars($roomtype); ?>">
                            </div>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">Start Time</label>
                                <input type="time" name="starttime" class="form-input" value="<?php echo htmlspecialchars($starttime); ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">End Time</label>
                                <input type="time" name="endtime" class="form-input" value="<?php echo htmlspecialchars($endtime); ?>" required>
                            </div>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">Building</label>
                                <input type="text" name="building" class="form-input" value="<?php echo htmlspecialchars($building); ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Room Number</label>
                                <input type="text" name="roomnumber" class="form-input" value="<?php echo htmlspecialchars($roomnumber); ?>">
                            </div>
                        </div>

                        <input type="submit" value="Update Schedule" class="form-submit">
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </main>
</div>
