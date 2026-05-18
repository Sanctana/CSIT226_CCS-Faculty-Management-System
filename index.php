<?php
include 'connections/connect.php';

$id = $_SESSION['user_id'] ?? null;
if ($id) {
    header("location: dashboard.php");
    exit();
}
?>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">

<title>Faculty Workload Management System</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/index.css">

<body>
    <div class="wrap">
        <main class="hero">
            <div class="logo">
                <span class="gear"></span>
                <strong>Cebu Institute of Technology - University</strong>
            </div>
            <h1>Faculty Workload<br>Management<br>System</h1>
            <div class="subtitle">College of Computer Studies</div>
            <div class="lead">An integrated system to manage faculty assignments, course schedules, and workload distribution, providing accurate records and reports for academic administration.</div>
        </main>

        <aside class="auth">
            <h2>Welcome Back!</h2>
            <p class="lead">Please sign in to manage assignments</p>
            <form class="form" method="post" action="#">
                <input type="hidden" name="form_type" value="login">
                <div class="input">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" placeholder="Email" required>
                </div>
                <div class="input">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" placeholder="Password" required>
                </div>
                <div class="row">
                    <label class="remember"><input type="checkbox"> Remember Me</label>
                    <a href="registerfaculty.php" style="color:#3b2b1f;text-decoration:none;font-size:14px">Need help logging in?</a>
                </div>
                <button class="btn" type="submit">Log In</button>
            </form>
        </aside>
    </div>

    <div id="messageBoxOverlay" class="message-box-overlay">
        <div class="message-box">
            <h3>Login Error</h3>
            <p id="messageBoxText"></p>
            <button class="message-box-btn" onclick="closeMessageBox()">OK</button>
        </div>
    </div>

    <script>
        function showMessageBox(message) {
            document.getElementById('messageBoxText').textContent = message;
            document.getElementById('messageBoxOverlay').classList.add('active');
        }

        function closeMessageBox() {
            document.getElementById('messageBoxOverlay').classList.remove('active');
        }

        window.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeMessageBox();
            }
        });
    </script>
</body>

<?php
if (isset($_POST['form_type']) && $_POST['form_type'] === 'login') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $stmt = $connection->prepare("SELECT id, password, firstname FROM tbluser WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['firstname'] = $row['firstname'];

            $stmt = $connection->prepare("SELECT * FROM tbldepartmenthead WHERE id = ?");
            $stmt->bind_param("i", $row['id']);
            $stmt->execute();
            $deptHeadResult = $stmt->get_result();

            if ($deptHeadResult->num_rows > 0) {
                $_SESSION['role'] = 'department_head';
            } else {
                $_SESSION['role'] = 'faculty';
            }

            header("location: dashboard.php");
            exit();
        } else {
            echo "<script>showMessageBox('Invalid email or password. Please try again.');</script>";
        }
    } else {
        echo "<script>showMessageBox('Invalid email or password. Please try again.');</script>";
    }
}
