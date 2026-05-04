<!--test ui code-->
<?php
include 'connections/connect.php';
require_once 'assets/includes/sidebar.php';
$pageTitle = "Faculty Profile";

// Assume faculty ID is 1 for now
$faculty_id = 1;

// Fetch faculty info
$query = "SELECT u.firstname, u.lastname, u.email, u.contactnumber, f.specialization, u.employeestatus 
          FROM tbluser u JOIN tblfaculty f ON u.id = f.id WHERE f.id = $faculty_id";
$result = mysqli_query($connection, $query);
$faculty = mysqli_fetch_assoc($result);

// Fetch education
$edu_query = "SELECT * FROM tbleducation WHERE faculty_id = $faculty_id";
$edu_result = mysqli_query($connection, $edu_query);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCS | Faculty Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <link rel="stylesheet" href="assets/css/topbar.css">
    <link rel="stylesheet" href="assets/css/variables.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <link rel="stylesheet" href="assets/css/formtemplate.css">
</head>
<body>
    <div class="main-wrapper">
        <?php require_once 'assets/includes/topbar.php'; ?>

        <main class="content-body">
            <div class="container">
                <div class="profile-panel">
                    <h2>Faculty Profile</h2>
                    <div class="profile-info">
                        <p><strong>Name:</strong> <?php echo $faculty['firstname'] . ' ' . $faculty['lastname']; ?></p>
                        <p><strong>Email:</strong> <?php echo $faculty['email']; ?></p>
                        <p><strong>Contact Number:</strong> <?php echo $faculty['contactnumber']; ?></p>
                        <p><strong>Specialization:</strong> <?php echo $faculty['specialization']; ?></p>
                        <p><strong>Employee Status:</strong> <?php echo $faculty['employeestatus']; ?></p>
                    </div>

                    <h3>Educational Background</h3>
                    <table class="education-table">
                        <thead>
                            <tr>
                                <th>Degree</th>
                                <th>Institution</th>
                                <th>Year Graduated</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($edu = mysqli_fetch_assoc($edu_result)) { ?>
                                <tr>
                                    <td><?php echo $edu['degree']; ?></td>
                                    <td><?php echo $edu['institution']; ?></td>
                                    <td><?php echo $edu['yeargraduated']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>


<!--delete logic-->
<?php
// Handle delete
if (isset($_GET['delete_id'])) {
    $delete_id = (int) $_GET['delete_id'];
    if ($delete_id > 0) {
        $delete_query = "DELETE FROM tblfacultyeducation WHERE id = $delete_id AND facultyid = $faculty_id";
        mysqli_query($connection, $delete_query);
    }
    header("Location: facultyprofile.php");
    exit();
}



