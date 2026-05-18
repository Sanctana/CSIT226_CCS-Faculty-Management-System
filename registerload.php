<?php
include 'connections/connect.php';
require_once 'assets/includes/sidebar.php';

$pageTitle = "Workload Assignment";

$success = '';
$errors = [];
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
<link rel="stylesheet" href="assets/css/registerLoad.css">

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

                <?php if (!empty($errors)): ?>
                    <div class="form-error" style="margin:8px 0;">
                        <?php foreach ($errors as $err) {
                            echo '<div style="color:#b00020">' . htmlspecialchars($err) . '</div>';
                        } ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($success)): ?>
                    <div class="form-success" style="margin:8px 0; color:green;">
                        <?php echo htmlspecialchars($success); ?>
                    </div>
                <?php endif; ?>

                <form method="post">

                    <div class="form-grid">

                        <div class="form-group">
                            <label class="form-label">Teacher</label>
                            <select name="teacher" class="form-select" required>
                                <option value="">Select Teacher</option>
                                <?php
                                $teacherQuery = "SELECT u.id, u.firstname, u.lastname FROM tbluser u JOIN tblfaculty f ON u.id = f.id";
                                $teacherResult = $connection->query($teacherQuery);

                                if ($teacherResult->num_rows > 0) {
                                    while ($row = $teacherResult->fetch_assoc()) {
                                        echo "<option value='{$row['id']}'>{$row['firstname']} {$row['lastname']}</option>";
                                    }
                                }
                                ?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Year Level</label>
                            <select name="year_level" id="year_level" class="form-select" required>
                                <option value="">Select Year Level</option>
                                <option value="1">1st Year</option>
                                <option value="2">2nd Year</option>
                                <option value="3">3rd Year</option>
                                <option value="4">4th Year</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Section</label>
                            <select name="section" id="section_select" class="form-select" required>
                                <option value="">Select Section</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Course Code</label>
                            <select name="course_code" id="course_select" class="form-select" required>
                                <option value="">Select Course</option>
                            </select>
                        </div>

                        <div class="form-group" style="grid-column:1/-1;">
                            <label class="form-label">Create Schedule</label>
                            <div id="schedules_container">
                                <div class="schedule-row" style="display:flex;gap:8px;flex-wrap:wrap;align-items:center;margin-bottom:8px;">
                                    <select name="schedule_day[]" class="form-select" required>
                                        <option value="">Day</option>
                                        <option value="M">M</option>
                                        <option value="T">T</option>
                                        <option value="W">W</option>
                                        <option value="TH">TH</option>
                                        <option value="F">F</option>
                                        <option value="SAT">SAT</option>
                                        <option value="SUN">SUN</option>
                                    </select>
                                    <input type="time" name="schedule_start[]" class="form-input" required>
                                    <input type="time" name="schedule_end[]" class="form-input" required>
                                    <input type="text" name="schedule_roomtype[]" class="form-input" placeholder="Room Type">
                                    <input type="text" name="schedule_building[]" class="form-input" placeholder="Building">
                                    <input type="text" name="schedule_roomnumber[]" class="form-input" placeholder="Room #">
                                    <button type="button" class="btn-remove-schedule" style="background:#eee;border:1px solid #ccc;padding:6px 8px;border-radius:4px;">Remove</button>
                                </div>
                            </div>
                            <button type="button" id="add_schedule_btn" class="form-submit" style="margin-top:8px;">Add Schedule</button>
                        </div>

                    </div>

                    <input type="submit" name="btnAssign" value="Assign Workload" class="form-submit">

                </form>
            </div>

        </div>
    </main>


</div>

<div class="confirm-overlay" id="confirmOverlay" aria-hidden="true">
    <div class="confirm-modal" role="dialog" aria-modal="true" aria-labelledby="confirmTitle">
        <div class="confirm-header" id="confirmTitle">Confirm Workload Assignment</div>
        <div class="confirm-body">
            Please review the information before saving.
            <ul class="confirm-list" id="confirmList"></ul>
        </div>
        <div class="confirm-actions">
            <button type="button" class="confirm-btn cancel" id="confirmCancel">Cancel</button>
            <button type="button" class="confirm-btn primary" id="confirmOk">Save</button>
        </div>
    </div>
</div>

<script src="assets/js/registerLoad.js"></script>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnAssign'])) {
    $teacher = isset($_POST['teacher']) ? intval($_POST['teacher']) : 0;
    $year_level = isset($_POST['year_level']) ? intval($_POST['year_level']) : 0;
    $section_id = isset($_POST['section']) ? intval($_POST['section']) : 0;
    $course_id = isset($_POST['course_code']) ? intval($_POST['course_code']) : 0;

    if (!$teacher) $errors[] = "Please select a teacher.";
    if (!$year_level) $errors[] = "Please select a year level.";
    if (!$section_id) $errors[] = "Please select a section.";
    if (!$course_id) $errors[] = "Please select a course.";

    if (empty($errors)) {
        try {
            $connection->begin_transaction();

            $sectionName = '';
            $stmt = $connection->prepare("SELECT sectionname FROM tblsection WHERE sectionid = ?");
            $stmt->bind_param("i", $section_id);
            $stmt->execute();
            $res = $stmt->get_result();
            if ($row = $res->fetch_assoc()) {
                $sectionName = $row['sectionname'];
            }
            $stmt->close();

            $currentYear = intval(date('Y'));
            $schoolyear = $currentYear . '-' . ($currentYear + 1);

            // Insert teaching assignment (include teacher)
            $stmt = $connection->prepare("INSERT INTO tblteachingassignment (schoolyear, section, coursecodeid, teacherid) VALUES (?, ?, ?, ?)");
            if (!$stmt) {
                throw new Exception('Prepare failed: ' . $connection->error);
            }
            $stmt->bind_param("ssii", $schoolyear, $sectionName, $course_id, $teacher);
            if (!$stmt->execute()) {
                throw new Exception('Execute failed: ' . $stmt->error);
            }
            $assignmentId = $connection->insert_id;
            $stmt->close();

            // Collect schedules (arrays from the form)
            $days = $_POST['schedule_day'] ?? [];
            $starts = $_POST['schedule_start'] ?? [];
            $ends = $_POST['schedule_end'] ?? [];
            $roomtypes = $_POST['schedule_roomtype'] ?? [];
            $buildings = $_POST['schedule_building'] ?? [];
            $roomnumbers = $_POST['schedule_roomnumber'] ?? [];

            // Build an array of new schedules and validate entries
            $newSchedules = [];
            for ($i = 0; $i < count($days); $i++) {
                $d = trim($days[$i]);
                $s = trim($starts[$i] ?? '');
                $e = trim($ends[$i] ?? '');
                $rt = trim($roomtypes[$i] ?? '');
                $b = trim($buildings[$i] ?? '');
                $rn = trim($roomnumbers[$i] ?? '');

                // Skip incomplete rows
                if ($d === '' || $s === '' || $e === '') {
                    continue;
                }

                // Validate time order
                if ($s >= $e) {
                    $errors[] = "Start time must be before end time for {$d} {$s}-{$e}.";
                    break;
                }

                $newSchedules[] = [
                    'day' => $d,
                    'start' => $s,
                    'end' => $e,
                    'roomtype' => $rt,
                    'building' => $b,
                    'roomnumber' => $rn
                ];
            }

            if (count($newSchedules) === 0) {
                $errors[] = "Please add at least one complete schedule.";
            }

            // Check for internal conflicts among the submitted schedules
            $hasInternalConflict = false;
            for ($i = 0; $i < count($newSchedules); $i++) {
                for ($j = $i + 1; $j < count($newSchedules); $j++) {
                    if ($newSchedules[$i]['day'] === $newSchedules[$j]['day']) {
                        $s1 = $newSchedules[$i]['start'];
                        $e1 = $newSchedules[$i]['end'];
                        $s2 = $newSchedules[$j]['start'];
                        $e2 = $newSchedules[$j]['end'];
                        // overlap if NOT (e1 <= s2 OR s1 >= e2)
                        if (!($e1 <= $s2 || $s1 >= $e2)) {
                            $errors[] = "Submitted schedules conflict on {$newSchedules[$i]['day']} ({$s1}-{$e1} conflicts with {$s2}-{$e2}).";
                            $hasInternalConflict = true;
                            break 2;
                        }
                    }
                }
            }

            // If internal conflicts found, rollback and stop
            if ($hasInternalConflict || !empty($errors)) {
                $connection->rollback();
            } else {
                // Check DB conflicts for each new schedule: room, teacher, section
                foreach ($newSchedules as $ns) {
                    // Room conflict (only if roomnumber provided)
                    if ($ns['roomnumber'] !== '') {
                        $roomStmt = $connection->prepare(
                            "SELECT COUNT(*) AS cnt FROM tblcourseschedule WHERE dayofweek = ? AND building = ? AND roomnumber = ? AND NOT (endtime <= ? OR starttime >= ?)"
                        );

                        if (!$roomStmt) {
                            throw new Exception('Prepare failed: ' . $connection->error);
                        }

                        $roomStmt->bind_param("sssss", $ns['day'], $ns['building'], $ns['roomnumber'], $ns['start'], $ns['end']);
                        $roomStmt->execute();
                        $roomCnt = $roomStmt->get_result()->fetch_assoc()['cnt'] ?? 0;
                        $roomStmt->close();
                        if ($roomCnt > 0) {
                            $errors[] = "Room {$ns['roomnumber']} in {$ns['building']} is already booked on {$ns['day']} {$ns['start']}-{$ns['end']}.";
                            break;
                        }
                    }

                    // Teacher conflict
                    $teachStmt = $connection->prepare(
                        "SELECT COUNT(*) AS cnt FROM tblcourseschedule s JOIN tblteachingassignment t ON s.assignmentid = t.assignmentid WHERE s.dayofweek = ? AND NOT (s.endtime <= ? OR s.starttime >= ?) AND t.teacherid = ?"
                    );
                    if (!$teachStmt) {
                        throw new Exception('Prepare failed: ' . $connection->error);
                    }
                    $teachStmt->bind_param("sssi", $ns['day'], $ns['start'], $ns['end'], $teacher);
                    $teachStmt->execute();
                    $teachCnt = $teachStmt->get_result()->fetch_assoc()['cnt'] ?? 0;
                    $teachStmt->close();
                    if ($teachCnt > 0) {
                        $errors[] = "Selected teacher is already assigned another class on {$ns['day']} {$ns['start']}-{$ns['end']}.";
                        break;
                    }

                    // Section conflict
                    $secStmt = $connection->prepare(
                        "SELECT COUNT(*) AS cnt FROM tblcourseschedule s JOIN tblteachingassignment t ON s.assignmentid = t.assignmentid WHERE s.dayofweek = ? AND NOT (s.endtime <= ? OR s.starttime >= ?) AND t.section = ?"
                    );
                    if (!$secStmt) {
                        throw new Exception('Prepare failed: ' . $connection->error);
                    }
                    $secStmt->bind_param("ssss", $ns['day'], $ns['start'], $ns['end'], $sectionName);
                    $secStmt->execute();
                    $secCnt = $secStmt->get_result()->fetch_assoc()['cnt'] ?? 0;
                    $secStmt->close();
                    if ($secCnt > 0) {
                        $errors[] = "Section {$sectionName} already has a class on {$ns['day']} {$ns['start']}-{$ns['end']}.";
                        break;
                    }
                }

                if (!empty($errors)) {
                    $connection->rollback();
                } else {
                    // No conflicts: insert schedules
                    if (count($newSchedules) > 0) {
                        $schedStmt = $connection->prepare("INSERT INTO tblcourseschedule (dayofweek, starttime, endtime, roomtype, building, roomnumber, assignmentid) VALUES (?, ?, ?, ?, ?, ?, ?)");
                        if (!$schedStmt) {
                            throw new Exception('Prepare failed: ' . $connection->error);
                        }
                        foreach ($newSchedules as $ns) {
                            $schedStmt->bind_param("ssssssi", $ns['day'], $ns['start'], $ns['end'], $ns['roomtype'], $ns['building'], $ns['roomnumber'], $assignmentId);
                            if (!$schedStmt->execute()) {
                                throw new Exception('Execute failed: ' . $schedStmt->error);
                            }
                        }
                        $schedStmt->close();
                    }

                    $connection->commit();
                    $success = "Workload assigned and schedules created successfully.";
                }
            }
        } catch (Exception $ex) {
            $connection->rollback();
            $errors[] = "Database error: " . $ex->getMessage();
        }
    }
}
