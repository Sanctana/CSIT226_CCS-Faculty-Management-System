<?php
include 'connections/connect.php';
$pageTitle = "Dashboard";

$isAdmin = $_SESSION['role']  === 'department_head';
$schedules = [];

// Map day of week numbers to names
$dayNames = [
    'M' => 'Monday',
    'T' => 'Tuesday',
    'W' => 'Wednesday',
    'TH' => 'Thursday',
    'F' => 'Friday',
    'SAT' => 'Saturday',
    'SUN' => 'Sunday'
];

if ($isAdmin) {
    // Admin sees all schedules
    $scheduleQuery = "
        SELECT 
            cs.scheduleid,
            cs.dayofweek,
            cs.starttime,
            cs.endtime,
            cs.roomtype,
            cs.building,
            cs.roomnumber,
            c.coursetitle,
            c.coursecode,
            u.firstname,
            u.lastname,
            ta.schoolyear,
            ta.section
        FROM tblcourseschedule cs
        JOIN tblteachingassignment ta ON cs.assignmentid = ta.assignmentid
        JOIN tblcourse c ON ta.coursecodeid = c.coursecodeid
        JOIN tblfaculty f ON ta.teacherid = f.id
        JOIN tbluser u ON f.id = u.id
        ORDER BY cs.dayofweek, cs.starttime
    ";
} else {
    // Faculty sees only their own schedules
    $currentUserId = $_SESSION['user_id'] ?? 0;
    $scheduleQuery = "
        SELECT 
            cs.scheduleid,
            cs.dayofweek,
            cs.starttime,
            cs.endtime,
            cs.roomtype,
            cs.building,
            cs.roomnumber,
            c.coursetitle,
            c.coursecode,
            u.firstname,
            u.lastname,
            ta.schoolyear,
            ta.section
        FROM tblcourseschedule cs
        JOIN tblteachingassignment ta ON cs.assignmentid = ta.assignmentid
        JOIN tblcourse c ON ta.coursecodeid = c.coursecodeid
        JOIN tblfaculty f ON ta.teacherid = f.id
        JOIN tbluser u ON f.id = u.id
        WHERE ta.teacherid = $currentUserId
        ORDER BY cs.dayofweek, cs.starttime
    ";
}

$scheduleResult = $connection->query($scheduleQuery);
if ($scheduleResult) {
    while ($row = $scheduleResult->fetch_assoc()) {
        $schedules[] = $row;
    }
}
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CCS | Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet" href="assets/css/variables.css">
<link rel="stylesheet" href="assets/css/sidebar.css">
<link rel="stylesheet" href="assets/css/topbar.css">
<link rel="stylesheet" href="assets/css/components.css">
<link rel="stylesheet" href="assets/css/dashboard.css">

<script src="assets/js/dashboard.js" defer></script>

<?php require_once 'assets/includes/sidebar.php'; ?>

<div class="main-wrapper">
    <?php require_once 'assets/includes/topbar.php'; ?>

    <main class="content-body">
        <div class="container">
            <!-- Welcome Section -->
            <div class="welcome-text">
                <h1>Welcome Back, <span><?php echo htmlspecialchars($_SESSION['firstname']); ?></span></h1>
                <p>Here are your quick actions for managing the department.</p>
            </div>

            <!-- Schedules Section -->
            <div class="content-card">
                <div class="schedule-header">
                    <h2><?php echo $isAdmin ? 'All Faculty Schedules' : 'Your Schedules'; ?></h2>
                    <p class="schedule-subtitle">
                        <?php echo $isAdmin ? 'Viewing all faculty teaching schedules' : 'Your current teaching assignments'; ?>
                    </p>
                </div>

                <?php if (empty($schedules)): ?>
                    <div class="no-schedules">
                        <p>No schedules found.</p>
                    </div>
                <?php else: ?>
                    <div class="schedules-grid">
                        <?php foreach ($schedules as $schedule): ?>
                            <div class="schedule-card">
                                <div class="schedule-card-header">
                                    <div class="course-info">
                                        <h3 class="course-title"><?php echo htmlspecialchars($schedule['coursetitle']); ?></h3>
                                        <p class="course-code"><?php echo htmlspecialchars($schedule['coursecode']); ?></p>
                                    </div>
                                    <span class="school-year"><?php echo htmlspecialchars($schedule['schoolyear']); ?></span>
                                </div>

                                <div class="schedule-card-body">
                                    <?php if ($isAdmin): ?>
                                        <div class="schedule-item">
                                            <span class="label">Faculty:</span>
                                            <span class="value"><?php echo htmlspecialchars($schedule['firstname'] . ' ' . $schedule['lastname']); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <div class="schedule-item">
                                        <span class="label">Section:</span>
                                        <span class="value"><?php echo htmlspecialchars($schedule['section']); ?></span>
                                    </div>

                                    <div class="schedule-item">
                                        <span class="label">Day:</span>
                                        <span class="value"><?php echo htmlspecialchars($dayNames[$schedule['dayofweek']]); ?></span>
                                    </div>

                                    <div class="schedule-item">
                                        <span class="label">Time:</span>
                                        <span class="value">
                                            <?php
                                            echo htmlspecialchars(date('h:i A', strtotime($schedule['starttime']))) . ' - ' .
                                                htmlspecialchars(date('h:i A', strtotime($schedule['endtime'])));
                                            ?>
                                        </span>
                                    </div>

                                    <div class="schedule-item">
                                        <span class="label">Location:</span>
                                        <span class="value">
                                            <?php
                                            echo htmlspecialchars($schedule['building'] . ' - ' .
                                                $schedule['roomnumber'] . ' (' . $schedule['roomtype'] . ')');
                                            ?>
                                        </span>
                                    </div>

                                    <?php if ($isAdmin): ?>
                                        <div class="schedule-card-actions">
                                            <a href="editschedule.php?id=<?php echo (int) $schedule['scheduleid']; ?>" class="btn-edit">Edit</a>
                                            <a href="dashboard.php?delete_schedule_id=<?php echo (int) $schedule['scheduleid']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this schedule?');">Delete</a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
</div>

<?php
if ($isAdmin && isset($_GET['delete_schedule_id']) && ctype_digit($_GET['delete_schedule_id'])) {
    $scheduleId = (int) $_GET['delete_schedule_id'];

    $assignmentId = 0;
    $stmt = $connection->prepare("SELECT assignmentid FROM tblcourseschedule WHERE scheduleid = ?");
    $stmt->bind_param("i", $scheduleId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $assignmentId = (int) $row['assignmentid'];
    }
    $stmt->close();

    if ($assignmentId > 0) {
        $deleteStmt = $connection->prepare("DELETE FROM tblcourseschedule WHERE scheduleid = ?");
        $deleteStmt->bind_param("i", $scheduleId);
        $deleteStmt->execute();
        $deleteStmt->close();

        $countStmt = $connection->prepare("SELECT COUNT(*) AS cnt FROM tblcourseschedule WHERE assignmentid = ?");
        $countStmt->bind_param("i", $assignmentId);
        $countStmt->execute();
        $countResult = $countStmt->get_result();
        $remaining = (int) ($countResult->fetch_assoc()['cnt'] ?? 0);
        $countStmt->close();

        if ($remaining === 0) {
            $assignmentDelete = $connection->prepare("DELETE FROM tblteachingassignment WHERE assignmentid = ?");
            $assignmentDelete->bind_param("i", $assignmentId);
            $assignmentDelete->execute();
            $assignmentDelete->close();
        }
    }

    header('Location: dashboard.php');
    exit();
}

