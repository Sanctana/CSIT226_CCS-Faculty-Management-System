<?php
include 'connections/connect.php';

$isEditMode = false;
$courseId = 0;
$coursecode = '';
$coursetitle = '';
$units = '';
$yearlevel = '';
$errorMessage = '';

if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $courseId = (int) $_GET['id'];

    if ($courseId > 0) {
        $stmt = $connection->prepare("SELECT coursecode, coursetitle, units, year_level FROM tblcourse WHERE coursecodeid = ? LIMIT 1");
        $stmt->bind_param("i", $courseId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $isEditMode = true;
            $coursecode = $row['coursecode'];
            $coursetitle = $row['coursetitle'];
            $units = $row['units'];
            $yearlevel = $row['year_level'];
        } else {
            $errorMessage = 'Course not found.';
        }
    }
}

$pageTitle = $isEditMode ? 'Edit Course' : 'Register Course';
$formTitle = $isEditMode ? 'Edit Course' : 'Course Registration';
$submitLabel = $isEditMode ? 'Update Course' : 'Register Course';
$formType = $isEditMode ? 'course_update' : 'course_registration';

require_once 'assets/includes/sidebar.php';
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CCS | Course Registration</title>


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
                    <a href="managementcourse.php" class="back-icon">
                        <img src="assets/img/back.png" alt="Back">
                    </a>
                    <h2><?php echo htmlspecialchars($formTitle); ?></h2>
                </div>

                <div class="form-divider"></div>

                <?php if ($errorMessage !== ''): ?>
                    <div id="courseError" class="record-subtitle" style="color: #b42318; margin-bottom: 12px;">
                        <?php echo htmlspecialchars($errorMessage); ?>
                    </div>
                <?php else: ?>
                    <div id="courseError" class="record-subtitle" style="color: #b42318; margin-bottom: 12px; display: none;"></div>
                <?php endif; ?>


                <form method="post">
                    <input type="hidden" name="form_type" value="<?php echo htmlspecialchars($formType); ?>">
                    <?php if ($isEditMode): ?>
                        <input type="hidden" name="course_id" value="<?php echo (int) $courseId; ?>">
                    <?php endif; ?>
                    <div class="form-grid">


                        <div class="form-group">
                            <label class="form-label">Course Code</label>
                            <input type="text" name="coursecode" class="form-input" value="<?php echo htmlspecialchars((string) $coursecode); ?>" required>
                        </div>


                        <div class="form-group">
                            <label class="form-label">Course Title</label>
                            <input type="text" name="coursetitle" class="form-input" value="<?php echo htmlspecialchars((string) $coursetitle); ?>" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Units</label>
                            <input type="number" name="units" class="form-input" value="<?php echo htmlspecialchars((string) $units); ?>" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Year Level</label>
                            <input type="number" name="yearlevel" class="form-input" value="<?php echo htmlspecialchars((string) $yearlevel); ?>" required>
                        </div>

                    </div>

                    <input type="submit" name="btnRegister" value="<?php echo htmlspecialchars($submitLabel); ?>" class="form-submit">

                </form>
            </div>

        </div>
    </main>

</div>

<div id="confirmOverlay" class="confirm-overlay" aria-hidden="true">
    <div class="confirm-modal" role="dialog" aria-modal="true" aria-labelledby="confirmTitle">
        <div class="confirm-header" id="confirmTitle">Confirm Course Details</div>
        <div class="confirm-body">
            <p>Review the details before saving.</p>
            <ul id="confirmList" class="confirm-list"></ul>
        </div>
        <div class="confirm-actions">
            <button type="button" id="confirmCancel" class="confirm-btn cancel">Cancel</button>
            <button type="button" id="confirmOk" class="confirm-btn primary">Confirm</button>
        </div>
    </div>
</div>

<script src="assets/js/registercourse.js" defer></script>


<?php

if (isset($_POST['form_type']) && in_array($_POST['form_type'], ['course_registration', 'course_update'], true)) {
    $formType = $_POST['form_type'];
    $postedCourseId = isset($_POST['course_id']) && ctype_digit($_POST['course_id']) ? (int) $_POST['course_id'] : 0;

    $coursecode = trim($_POST['coursecode'] ?? '');
    $coursetitle = trim($_POST['coursetitle'] ?? '');
    $units = (int) ($_POST['units'] ?? 0);
    $yearlevel = (int) ($_POST['yearlevel'] ?? 0);

    $isSaved = false;

    if ($formType === 'course_update' && $postedCourseId > 0) {
        $isEditMode = true;
        $courseId = $postedCourseId;

        $stmt = $connection->prepare("UPDATE tblcourse SET coursecode = ?, coursetitle = ?, units = ?, year_level = ? WHERE coursecodeid = ?");
        if ($stmt) {
            $stmt->bind_param("ssiii", $coursecode, $coursetitle, $units, $yearlevel, $courseId);
            $isSaved = $stmt->execute();
            if (!$isSaved) {
                $errorMessage = 'Failed to save course: ' . $stmt->error;
            }
            $stmt->close();
        } else {
            $errorMessage = 'Failed to save course: ' . $connection->error;
        }
    } else {
        $isEditMode = false;

        $stmt = $connection->prepare("INSERT INTO tblcourse (coursecode, coursetitle, units, year_level) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("ssii", $coursecode, $coursetitle, $units, $yearlevel);
            $isSaved = $stmt->execute();
            if (!$isSaved) {
                $errorMessage = 'Failed to save course: ' . $stmt->error;
            }
            $stmt->close();
        } else {
            $errorMessage = 'Failed to save course: ' . $connection->error;
        }
    }

    if ($isSaved) {
        echo "<script>window.location.href='managementcourse.php';</script>";
        exit();
    }

    if ($errorMessage === '') {
        $errorMessage = 'Failed to save course.';
    }

    $encodedError = json_encode($errorMessage, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    echo "<script>(function(){var el=document.getElementById('courseError');if(el){el.textContent={$encodedError};el.style.display='block';}})();</script>";
}
