<?php
    include 'connections/connect.php';
?>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">


    <title>Faculty Workload Management System</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/index.css">


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
            <button class="btn" type="submit"><a href="dashboard.php">Log In</a></button>
        </form>
    </aside>
</div>
