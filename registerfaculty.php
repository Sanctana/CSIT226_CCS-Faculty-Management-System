<?php
include 'connections/connect.php';
require_once 'assets/includes/sidebar.php';

$pageTitle = "Register Faculty";

$saved = false;
$savedMessage = '';
$isError = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    $stmt = $connection->prepare("SELECT id FROM tbluser WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $savedMessage = 'Email already exists. Please use a different email.';
        $isError = true;
    } else {

        //save data to tbluser
        $sql1 = "Insert into tbluser(firstname,lastname,birthdate,gender,email,contactnumber,password,employeestatus)
        values('" . $firstname . "','" . $lastname . "','" . $birthdate . "','" . $gender . "','" . $email . "','" . $contactnumber . "','" . $password . "','" . $employeestatus . "')";

        mysqli_query($connection, $sql1);

        $last_id = $connection->insert_id; // makuha ang last id, after insert data

        //save data to tblfaculty
        $sql1 = "Insert into tblfaculty(id,specialization) values(" . $last_id . ",'" . $specialization . "')";

        mysqli_query($connection, $sql1);

        $saved = true;
        $savedMessage = 'New record saved.';
    }
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

<style>
    .flash-message {
        position: fixed;
        top: 20px;
        right: 20px;
        background: #28a745;
        color: #fff;
        padding: 12px 16px;
        border-radius: 6px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        z-index: 9999;
        transition: opacity .3s ease;
    }

    .error-message {
        position: fixed;
        top: 20px;
        right: 20px;
        background: #dc3545;
        color: #fff;
        padding: 12px 16px;
        border-radius: 6px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        z-index: 9999;
        transition: opacity .3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .error-message::before {
        content: "⚠";
        font-weight: bold;
        font-size: 18px;
    }

    .confirm-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.55);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 10000;
        padding: 24px;
    }

    .confirm-overlay.is-open {
        display: flex;
    }

    .confirm-modal {
        background: #ffffff;
        color: #1f2937;
        width: min(560px, 100%);
        border-radius: 12px;
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.25);
        overflow: hidden;
    }

    .confirm-header {
        padding: 16px 20px;
        background: #0f172a;
        color: #ffffff;
        font-weight: 600;
        font-size: 16px;
    }

    .confirm-body {
        padding: 18px 20px 12px;
        font-size: 14px;
        line-height: 1.5;
    }

    .confirm-list {
        margin: 12px 0 0;
        padding: 0;
        list-style: none;
        display: grid;
        gap: 8px;
    }

    .confirm-item {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        padding-bottom: 6px;
        border-bottom: 1px dashed #e5e7eb;
    }

    .confirm-label {
        color: #6b7280;
        font-weight: 600;
    }

    .confirm-value {
        color: #111827;
        text-align: right;
        max-width: 60%;
        word-break: break-word;
    }

    .confirm-actions {
        padding: 14px 20px 18px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .confirm-btn {
        border: none;
        border-radius: 6px;
        padding: 10px 16px;
        font-weight: 600;
        cursor: pointer;
    }

    .confirm-btn.cancel {
        background: #e5e7eb;
        color: #111827;
    }

    .confirm-btn.primary {
        background: #2563eb;
        color: #ffffff;
    }
</style>


<div class="main-wrapper">
    <?php require_once 'assets/includes/topbar.php'; ?>

    <!-- body content -->
    <main class="content-body">
        <div class="container">
            <?php if ($saved): ?>
                <div class="flash-message"><?php echo htmlspecialchars($savedMessage); ?></div>
            <?php endif; ?>
            <?php if ($isError): ?>
                <div class="error-message"><?php echo htmlspecialchars($savedMessage); ?></div>
            <?php endif; ?>
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
                                <option value="Part-Time">Part-Time</option>
                                <option value="Full-Time">Full-Time</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Specialization</label>
                            <select name="txtspecialization" class="form-select" required>
                                <option value="No specialization">Select Specialization</option>
                                <option value="Mobile Development">Mobile Development</option>
                                <option value="Web Development">Web Development</option>
                                <option value="Information Management">Information Management</option>
                                <option value="Game Development">Game Development</option>
                                <option value="Cybersecurity">Cybersecurity</option>
                                <option value="Software Engineering">Software Engineering</option>
                                <option value="Cloud Computing">Cloud Computing</option>
                                <option value="UI/UX">UI/UX</option>
                                <option value="Data Analytics">Data Analytics</option>
                                <option value="Networking">Networking</option>
                                <option value="Artificial Intelligence">Artificial Intelligence</option>
                            </select>
                        </div>
                    </div>

                    <input type="submit" name="btnRegister" value="Register Faculty" class="form-submit">
                </form>
            </div>
        </div>
    </main>
</div>

<div class="confirm-overlay" id="confirmOverlay" aria-hidden="true">
    <div class="confirm-modal" role="dialog" aria-modal="true" aria-labelledby="confirmTitle">
        <div class="confirm-header" id="confirmTitle">Confirm Faculty Details</div>
        <div class="confirm-body">
            Please review the information before saving.
            <ul class="confirm-list" id="confirmList"></ul>
        </div>
        <div class="confirm-actions">
            <button type="button" class="confirm-btn cancel" id="confirmCancel">Cancel</button>
            <button type="button" class="confirm-btn primary" id="confirmOk">Save</button>
        </div>
    </div>
</div>
<script>
    (function() {
        var form = document.querySelector('form');
        if (!form) return;
        var confirmedOnce = false;
        var overlay = document.getElementById('confirmOverlay');
        var list = document.getElementById('confirmList');
        var cancelBtn = document.getElementById('confirmCancel');
        var okBtn = document.getElementById('confirmOk');
        var lastActive = null;

        var showModal = function() {
            overlay.classList.add('is-open');
            overlay.setAttribute('aria-hidden', 'false');
            lastActive = document.activeElement;
            okBtn.focus();
        };

        var hideModal = function() {
            overlay.classList.remove('is-open');
            overlay.setAttribute('aria-hidden', 'true');
            if (lastActive && typeof lastActive.focus === 'function') {
                lastActive.focus();
            }
        };

        var setListItem = function(label, value) {
            var item = document.createElement('li');
            item.className = 'confirm-item';
            var labelSpan = document.createElement('span');
            labelSpan.className = 'confirm-label';
            labelSpan.textContent = label;
            var valueSpan = document.createElement('span');
            valueSpan.className = 'confirm-value';
            valueSpan.textContent = value || '-';
            item.appendChild(labelSpan);
            item.appendChild(valueSpan);
            list.appendChild(item);
        };
        form.addEventListener('submit', function(e) {
            if (confirmedOnce) return;
            e.preventDefault();
            var get = function(name) {
                var el = form.querySelector('[name="' + name + '"]');
                return el ? el.value.trim() : '';
            };

            var firstname = get('txtfirstname');
            var lastname = get('txtlastname');
            var birthdate = get('txtbirth');
            var gender = get('txtgender');
            var genderText = gender === 'M' ? 'Male' : (gender === 'F' ? 'Female' : gender);
            var email = get('txtinstitutionalemail');
            var contactnumber = get('txtcontact');
            var employeestatus = get('txtemployeestatus');
            var specialization = get('txtspecialization');
            list.innerHTML = '';
            setListItem('Firstname', firstname);
            setListItem('Lastname', lastname);
            setListItem('Birthdate', birthdate);
            setListItem('Gender', genderText);
            setListItem('Email', email);
            setListItem('Contact Number', contactnumber);
            setListItem('Employment Status', employeestatus);
            setListItem('Specialization', specialization);
            showModal();
        });

        cancelBtn.addEventListener('click', function() {
            hideModal();
        });

        okBtn.addEventListener('click', function() {
            confirmedOnce = true;
            hideModal();
            form.submit();
        });

        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) {
                hideModal();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (!overlay.classList.contains('is-open')) return;
            if (e.key === 'Escape') {
                hideModal();
            }
        });
    })();
</script>
<?php if ($saved): ?>
    <script>
        (function() {
            var form = document.querySelector('form');
            if (form) {
                form.reset();
            }
            setTimeout(function() {
                var msg = document.querySelector('.flash-message');
                if (msg) msg.style.opacity = '0';
            }, 1500);
        })();
    </script>
<?php endif; ?>
<?php if ($isError): ?>
    <script>
        (function() {
            setTimeout(function() {
                var msg = document.querySelector('.error-message');
                if (msg) msg.style.opacity = '0';
            }, 3000);
        })();
    </script>
<?php endif; ?>