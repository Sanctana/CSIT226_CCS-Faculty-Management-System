<?php
include 'connections/connect.php';
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
    header("location: facultyrecord.php");
    exit();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCS | Faculty Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/dashboard.css">
    <style>
        /* form-specific styling */
        .form-panel {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            border: 1px solid var(--border-orange);
            padding: 40px;
            box-shadow: var(--shadow-sm);
        }

        .form-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .form-header h2 {
            font-size: 28px;
            font-weight: 800;
            color: var(--primary);
            letter-spacing: -1px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-input,
        .form-select {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-light);
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-dark);
            background: #fafaf9;
            transition: 0.2s;
        }

        .form-input:focus,
        .form-select:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 3px rgba(244, 123, 32, 0.1);
        }

        .form-submit {
            width: 100%;
            padding: 16px;
            background: var(--primary-grad);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
            margin-top: 16px;
            box-shadow: 0 4px 12px rgba(244, 123, 32, 0.2);
        }

        .form-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(244, 123, 32, 0.3);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <!-- my sidebar <3 -->
    <aside class="sidebar">
        <div class="logo-area"><img src="assets/img/ccs_logo.png" alt="FWMS Logo" class="logo-img">CCS AcadHub</div>
        <div class="nav-section">
            <div class="nav-label">Menu</div>
            <a href="dashboard.php" class="nav-item">Dashboard</a>
            <a href="facultyrecord.php" class="nav-item">Faculty Members</a>
            <a href="#" class="nav-item">Workload Assignment</a>
        </div>
        <div class="nav-section">
            <div class="nav-label">Curriculum</div>
            <a href="#" class="nav-item">Course Catalog</a>
            <a href="#" class="nav-item">Schedules</a>
        </div>
        <div style="margin-top: auto; padding: 24px; border-top: 1px solid var(--border-light);">
            <a href="#" class="nav-item" style="color: #cf1322;">Logout</a>
        </div>
    </aside>

    <div class="main-wrapper">
        <!-- top bar -->
        <header class="top-bar">
            <div class="breadcrumb">Academic Management / <span>Faculty Registration</span></div>
            <div class="header-right-group">
                <div class="semester-pill">
                    <div class="live-dot"></div>2nd Semester, AY 2023-2024
                </div>
                <div class="profile-trigger">
                    <div class="user-text">
                        <span class="user-name">Cherry Lyn Sta. Romana</span>
                        <span class="user-role">CS Department Head</span>
                    </div>
                    <div class="avatar" style="background: url('https://ui-avatars.com/api/?name=Cherry+Sta+Romana&background=f47b20&color=fff'); background-size: cover;"></div>
                </div>
            </div>
        </header>

        <!-- body content -->
        <main class="content-body">
            <div class="container">
                <div class="form-panel">
                    <div class="form-header">
                        <h2>Faculty Registration Page</h2>
                    </div>

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
</body>
</html>

