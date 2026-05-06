<?php
include 'connections/connect.php';
require_once 'assets/includes/sidebar.php';
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

    <?php require_once 'assets/includes/topbar.php'; ?>

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
                    <input type="hidden" name="form_type" value="section_registration">
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

                            <!--Reworked Program Form to show all programs within tblprogram (feel free to change kung hassle ra kaayo)  -->
                            <label class="form-label">Program</label>

                            <!-- uses programid instead to display program names based on program ID (more efficient but can be reverted back if too much na) -->
                            <select name="programid" class="form-select" required>
                                <?php
                                $result = mysqli_query($connection, "SELECT programid, programname FROM tblprogram");
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value = '{$row['programid']}'>
                                        {$row['programname']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <input type="submit" name="btnRegister" value="Register Section" class="form-submit">
                </form>
            </div>
        </div>
    </main>

</div>

<!-- save section info to DB-->
<?php
if (isset($_POST['btnRegister'])) {
    $sectionname = mysqli_real_escape_string($connection, trim($_POST['sectionname']));
    $yearlevel =  $_POST['yearlevel'];
    $programid =  $_POST['programid']; // based on dropdown option values

    $stmt = $connection->prepare("INSERT INTO tblsection (sectionname, yearlevel, programid) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $sectionname, $yearlevel, $programid);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>
                window.location.href = 'managementsection.php';
              </script>";
        exit();
    } else {
        $error = "Failed to save section: " . mysqli_error($connection);
    }
}

?>