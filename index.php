<?php
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Faculty Workload Management System</title>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
	<style>
		:root {
			--accent: #f47b20;
			--accent-2: #f7a86b;
			--muted: #f7f3f0;
			--text: #111;
		}

		* {
			box-sizing: border-box
		}

		html,
		body {
			height: 100%;
			margin: 0;
			font-family: 'Poppins', system-ui, Arial, sans-serif;
			color: var(--text)
		}

		body {
			background: linear-gradient(180deg, #fff 0%, #fbf7f5 100%)
		}

		.wrap {
			min-height: 100vh;
			display: flex
		}

		.hero {
			flex: 1;
			padding: 64px 72px;
			background: linear-gradient(180deg, rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0.6));
			display: flex;
			flex-direction: column;
			justify-content: center
		}

		.logo {
			display: flex;
			align-items: center;
			gap: 12px;
			color: #222;
			margin-bottom: 24px
		}

		.logo .gear {
			width: 28px;
			height: 28px;
			border-radius: 6px;
			background: #222;
			display: inline-block
		}

		h1 {
			font-size: 64px;
			line-height: 0.95;
			margin: 0 0 18px;
			font-weight: 800
		}

		.subtitle {
			font-size: 20px;
			color: #444;
			margin-bottom: 36px
		}

		.lead {
			max-width: 640px;
			color: #333;
			border-left: 4px solid #222;
			padding-left: 18px;
			font-size: 15px
		}

		.auth {
			width: 420px;
			padding: 56px;
			background: linear-gradient(180deg, var(--accent-2), #f6caa4);
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: stretch
		}

		.auth h2 {
			margin: 0 0 8px;
			font-size: 32px
		}

		.auth p.lead {
			font-size: 14px;
			color: #2b2b2b;
			margin: 0 0 20px
		}

		.form {
			display: flex;
			flex-direction: column;
			gap: 16px
		}

		.input {
			display: flex;
			flex-direction: column;
			gap: 6px
		}

		label {
			font-size: 13px;
			color: #2b2b2b
		}

		input[type="email"],
		input[type="password"] {
			padding: 12px 14px;
			border-radius: 8px;
			border: 2px solid rgba(0, 0, 0, 0.08);
			outline: none;
			font-size: 15px
		}

		input:focus {
			border-color: rgba(0, 0, 0, 0.18);
			box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06)
		}

		.row {
			display: flex;
			align-items: center;
			justify-content: space-between;
			margin-top: 8px
		}

		.remember {
			display: flex;
			align-items: center;
			gap: 8px;
			font-size: 14px
		}

		.btn {
			background: var(--accent);
			color: white;
			padding: 12px;
			border-radius: 28px;
			border: none;
			font-weight: 600;
			cursor: pointer;
			margin-top: 12px
		}

		.btn:active {
			transform: translateY(1px)
		}

		/* Responsive */
		@media (max-width:980px) {
			.wrap {
				flex-direction: column
			}

			.auth {
				width: 100%;
				padding: 36px
			}

			h1 {
				font-size: 44px
			}

			.hero {
				padding: 36px
			}
		}
	</style>
</head>

<body>
	<div class="wrap">
		<main class="hero">
			<div class="logo"><span class="gear"></span><strong>Cebu Institute of Technology - University</strong></div>
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
					<input id="email" name="email" type="email" placeholder="you@school.edu">
				</div>
				<div class="input">
					<label for="password">Password</label>
					<input id="password" name="password" type="password" placeholder="Password">
				</div>
				<div class="row">
					<label class="remember"><input type="checkbox"> Remember Me</label>
					<a href="#" style="color:#3b2b1f;text-decoration:none;font-size:14px">Need help logging in?</a>
				</div>
				<button class="btn" type="submit">Log In</button>
			</form>
		</aside>
	</div>
</body>

</html>