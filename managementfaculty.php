<?php
include 'connections/connect.php';
require_once 'assets/includes/sidebar.php';

$pageTitle = "Faculty Management";

$user_id = $_SESSION['user_id'] ?? 0;
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CCS | Faculty Records</title>

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
            <div class="record-panel">
                <div class="record-header">
                    <div>
                        <div class="record-title">Faculty Management</div>
                        <div class="record-subtitle">Manage and view all faculty members</div>
                    </div>
                    <a href="registerfaculty.php" class="add-btn">+ Add New Faculty</a>
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Faculty Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Specialization</th>
                            <th>Employment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // join tbluser and tblfaculty to get complete info
                        $sql = "SELECT u.id, u.firstname, u.lastname, u.email, u.contactnumber, u.employeestatus, f.specialization
                                FROM tbluser u
                                INNER JOIN tblfaculty f ON u.id = f.id WHERE u.id != $user_id"; // exclude current user
                        $result = mysqli_query($connection, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tr>
                                    <td><?php echo $row['firstname'] . " " . $row['lastname']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['contactnumber']; ?></td>
                                    <td><?php echo $row['specialization']; ?></td>
                                    <td><?php echo $row['employeestatus']; ?></td>
                                    <td>
                                        <a href="#"
                                            class="btn-delete"
                                            onclick="if(confirm('Are you sure you want to delete this faculty record?')) {
                                               window.location.href='managementfaculty.php?delete_id=<?php echo $row['id']; ?>';
                                               }">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='6'>No faculty records found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>


<?php

if (isset($_GET['delete_id'])) {
    $delete_id = (int) $_GET['delete_id'];
    if ($delete_id > 0) {
        mysqli_query($connection, "DELETE FROM tblfaculty WHERE id = $delete_id");
        mysqli_query($connection, "DELETE FROM tbluser WHERE id = $delete_id");
    }

    echo "<script>window.location.href='managementfaculty.php';</script>";
    exit();
}
?>