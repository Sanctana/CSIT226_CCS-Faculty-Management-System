<?php
include 'connections/connect.php';
require_once 'assets/includes/sidebar.php';

$pageTitle = "Register Faculty";

if (isset($_POST['btnRegister'])) {
    //retrieve data from form and save the value to a variable
    //for tbluser
    $firstname = $_POST['txtfirstname'];
    $lastname = $_POST['txtlastname'];
    $birthdate = $_POST['txtbirth'];
    $gender = $_POST['txtgender'];
    $email = $_POST['txtinstitutionalemail'];
    $contactnumber = $_POST['txtcontact'];
    $password = password_hash($_POST['txtpassword'], PASSWORD_DEFAULT);

    // if walay value (value="") undefined/null, kay iyahang i return kay empty string - right
    $employeestatus = $_POST['txtemployeestatus'] ?? '';

    //for tblfaculty
    $specialization = $_POST['txtspecialization'];

    //save data to tbluser
    $sql1 = "Insert into tbluser(firstname,lastname,birthdate,gender,email,contactnumber,password,employeestatus)
    values('" . $firstname . "','" . $lastname . "','" . $birthdate . "','" . $gender . "','" . $email . "','" . $contactnumber . "','" . $password . "','" . $employeestatus . "')";

    //    $sql1 ="Insert into tblstudent(firstname,lastname,program,yearlevel) values('".$fname."','".$lname."','".$program."',".$yearlevel.")";
    mysqli_query($connection, $sql1);

    $last_id = $connection->insert_id; // makuha ang last id, after insert data,

    //save data to tblfaculty
    $sql1 = "Insert into tblfaculty(id,specialization) values(" . $last_id . ",'" . $specialization . "')";

    mysqli_query($connection, $sql1);

    echo "<script language='javascript'>
			alert('New record saved.');
		      </script>";
    header("location: managementfaculty.php");
    exit();
}
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CCS | Faculty Registration</title>


<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet" href="assets/css/sidebar.css">
<link rel="stylesheet" href="assets/css/topbar.css">
<link rel="stylesheet" href="assets/css/variables.css">
<link rel="stylesheet" href="assets/css/components.css">
<link rel="stylesheet" href="assets/css/formtemplate.css">


<div class="main-wrapper">
    <?php require_once 'assets/includes/topbar.php'; ?>

    <!-- body content -->
    <main class="content-body">
        <div class="container">
            <div class="form-panel">
                <div class="form-header">
                    <a href="managementfaculty.php" class="back-icon">
                        <img src="assets/img/back.png" alt="Back">
                    </a>
                    <h2>Faculty Registration</h2>
                </div>

                <div class="form-divider"></div>

                <form method="post">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Firstname</label>
                            <input type="text" name="txtfirstname" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Lastname</label>
                            <input type="text" name="txtlastname" class="form-input" required>
                        </div>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="txtbirth" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Gender</label>
                            <select name="txtgender" class="form-select" required>
                                <option value="">Select Gender</option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Institutional Email</label>
                        <input type="email" name="txtinstitutionalemail" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Contact Number</label>
                        <input type="text" name="txtcontact" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" name="txtpassword" class="form-input" required>
                    </div>
                    <!--            TANGPOS.123456CITU-->

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Employment Status</label>
                            <select name="txtemployeestatus" class="form-select" required>
                                <option value="">Select Status</option>
                                <option value="PT">Part-Time</option>
                                <option value="FT">Full-Time</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Specialization</label>
                            <select name="txtspecialization" class="form-select" required>
                                <option value="">Select Specialization</option>
                                <option value="1">Mobile Development</option>
                                <option value="2">Web Development</option>
                                <option value="3">Information Management</option>
                                <option value="4">Game Development</option>
                            </select>
                        </div>
                    </div>

                    <input type="submit" name="btnRegister" value="Register Faculty" class="form-submit">
                </form>
            </div>
        </div>
    </main>
</div>