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

if (isset($_POST['form_type']) && in_array($_POST['form_type'], ['course_registration', 'course_update'], true)) {
    $formType = $_POST['form_type'];
    $postedCourseId = isset($_POST['course_id']) && ctype_digit($_POST['course_id']) ? (int) $_POST['course_id'] : 0;

    $coursecode = trim($_POST['coursecode'] ?? '');
    $coursetitle = trim($_POST['coursetitle'] ?? '');
    $units = (int) ($_POST['units'] ?? 0);
    $yearlevel = (int) ($_POST['yearlevel'] ?? 0);

    if ($formType === 'course_update' && $postedCourseId > 0) {
        $isEditMode = true;
        $courseId = $postedCourseId;

        $stmt = $connection->prepare("UPDATE tblcourse SET coursecode = ?, coursetitle = ?, units = ?, year_level = ? WHERE coursecodeid = ?");
        $stmt->bind_param("ssiii", $coursecode, $coursetitle, $units, $yearlevel, $courseId);
        $isSaved = $stmt->execute();
    } else {
        $isEditMode = false;

        $stmt = $connection->prepare("INSERT INTO tblcourse (coursecode, coursetitle, units, year_level) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssii", $coursecode, $coursetitle, $units, $yearlevel);
        $isSaved = $stmt->execute();
    }

    if ($isSaved) {
        header('Location: managementcourse.php');
        exit();
    }

    $errorMessage = 'Failed to save course: ' . $connection->error;
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
                    <div class="record-subtitle" style="color: #b42318; margin-bottom: 12px;">
                        <?php echo htmlspecialchars($errorMessage); ?>
                    </div>
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


<?php  
