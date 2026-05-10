<?php
include 'connections/connect.php';
require_once 'assets/includes/sidebar.php';
$pageTitle = "Add Education";
?>

<?php
    // checks if form is submitted
    if(isset($_POST['btnAdd'])) {
        // removes whitespace and makes values safe for SQL
        $degree = mysqli_real_escape_string($connection, trim($_POST['degree']));
        $school = mysqli_real_escape_string($connection, trim($_POST['school']));
        $year_graduated = (int) $_POST['year_graduated']; 

        // Assume the current faculty ID is 1 for now (replace with session later)
        $faculty_id =16;

        // perform sql insert
        $sql = "INSERT INTO tbleducation(faculty_id, degree, school, year_graduated) VALUES
                ($faculty_id, '$degree', '$school', $year_graduated)";
        
        // insert registered data to db and check
        if(mysqli_query($connection, $sql)) {
            header("Location: facultyprofile.php");
            exit();
        } else {
            $error = "Failed to add education: " .mysqli_error($connection);
        }
    }
?>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CCS | Add Education</title>


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
                    <a href="facultyprofile.php" class="back-icon">
                        <img src="assets/img/back.png" alt="Back">
                    </a>
                    <h2>Add Education</h2>
                </div>

                <div class="form-divider"></div>


                <form method="post">

                    <div class="form-grid">

                        <div class="form-group">
                            <label class="form-label">Degree</label>
                            <input type="text" name="degree" class="form-input" required>
                        </div>


                        <div class="form-group">
                            <label class="form-label">Institution</label>
                            <input type="text" name="school" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Year Graduated</label>
                            <input type="number" name="year_graduated" class="form-input" required>
                        </div>

                    </div>

                    <input type="submit" name="btnAdd" value="Add Education" class="form-submit">

                </form>
            </div>

        </div>
    </main>

</div>
</body>
</html>

