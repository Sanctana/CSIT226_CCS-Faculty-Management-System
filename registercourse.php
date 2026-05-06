<?php
include 'connections/connect.php';
require_once 'assets/includes/sidebar.php';

$pageTitle = "Register Course";
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
                    <h2>Course Registration</h2>
                </div>

                <div class="form-divider"></div>


                <form method="post">
                    <input type="hidden" name="form_type" value="course_registration">
                    <div class="form-grid">


                        <div class="form-group">
                            <label class="form-label">Course Code</label>
                            <input type="text" name="coursecode" class="form-input" required>
                        </div>


                        <div class="form-group">
                            <label class="form-label">Course Title</label>
                            <input type="text" name="coursetitle" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Units</label>
                            <input type="number" name="units" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Year Level</label>
                            <input type="number" name="yearlevel" class="form-input" required>
                        </div>

                    </div>

                    <input type="submit" name="btnRegister" value="Register Course" class="form-submit">

                </form>
            </div>

        </div>
    </main>

</div>

<!--insert registered course data into db -->
<?php
// checks if form is submitted
if (isset($_POST['form_type']) && $_POST['form_type'] === 'course_registration') {
    // removes whitespace and makes values safe for SQL
    $coursecode = mysqli_real_escape_string($connection, trim($_POST['coursecode']));
    $coursetitle = mysqli_real_escape_string($connection, trim($_POST['coursetitle']));
    $units = $_POST['units'];
    $yearlevel =  $_POST['yearlevel'];

    $stmt = $connection->prepare("INSERT INTO tblcourse (coursecode, coursetitle, units, year_level) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $coursecode, $coursetitle, $units, $yearlevel);
    $stmt->execute();

    // perform sql insert
    // insert registered data to db and check
    if ($stmt->affected_rows > 0) {
        header("Location: managementcourse.php");
        exit();
    } else {
        echo "Failed to save course: " . mysqli_error($connection);
    }
}
?>