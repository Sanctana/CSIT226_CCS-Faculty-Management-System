<?php
$username = 'Sta. Romana';
$role = 'CS Department Head';
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Faculty Management - Dashboard</title>
	<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;800&display=swap" rel="stylesheet">
	<style>
		:root {
			--peach: #ffd7c2;
			--accent: #ff7f2a;
			--dark: #6b2b17;
			--muted: #f7e9e4
		}

		* {
			box-sizing: border-box;
			font-family: 'Nunito', system-ui, Arial
		}

		body {
			margin: 0;
			background: linear-gradient(180deg, #fffaf8, #fff3ee);
			color: #3a1f15
		}

		.app {
			display: flex;
			min-height: 100vh
		}

		/* Sidebar */
		.sidebar {
			width: 220px;
			background: linear-gradient(180deg, #ffd9c4, #ffecd9);
			padding: 32px 18px
		}

		.brand {
			color: var(--dark);
			font-weight: 800;
			margin-bottom: 28px
		}

		.nav {
			list-style: none;
			padding: 0;
			margin: 0
		}

		.nav li {
			padding: 12px 6px;
			color: #4b2a1a
		}

		.nav li+li {
			margin-top: 6px
		}

		.logout {
			position: absolute;
			bottom: 24px;
			left: 18px;
			color: #6b2b17
		}

		/* Main */
		.main {
			flex: 1;
			padding: 28px 42px
		}

		.header {
			display: flex;
			justify-content: space-between;
			align-items: center
		}

		.welcome {
			font-size: 28px;
			font-weight: 800;
			color: #6b2b17
		}

		.subtle {
			color: #a66a45
		}

		.cards {
			display: flex;
			gap: 18px;
			margin: 22px 0
		}

		.card {
			background: #fff3ee;
			border-radius: 12px;
			padding: 18px 20px;
			box-shadow: 0 6px 12px rgba(247, 115, 35, 0.12);
			flex: 1
		}

		.card h3 {
			margin: 0;
			color: var(--muted);
			font-weight: 700
		}

		.card .num {
			font-size: 28px;
			font-weight: 800;
			margin-top: 6px;
			color: var(--dark)
		}

		.layout {
			display: grid;
			grid-template-columns: 1fr 320px;
			gap: 22px
		}

		.panel {
			background: #fff;
			border-radius: 14px;
			padding: 18px;
			box-shadow: 0 8px 18px rgba(255, 127, 42, 0.08)
		}

		.roles {
			height: 110px
		}

		.employment .row {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 12px
		}

		.progress {
			height: 12px;
			background: #ffe7db;
			border-radius: 8px;
			overflow: hidden
		}

		.progress>i {
			display: block;
			height: 100%;
			background: linear-gradient(90deg, #7ed957, #ff6b6b)
		}

		table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 12px
		}

		th,
		td {
			padding: 10px;
			border: 1px solid #ffd1b8;
			text-align: left;
			font-size: 14px
		}

		/* Right column */
		.stats {
			display: flex;
			flex-direction: column;
			gap: 18px
		}

		.calendar {
			height: 230px;
			background: linear-gradient(180deg, #fff, #fff);
			display: flex;
			align-items: center;
			justify-content: center;
			color: #b66a45
		}

		/* small widgets */
		.quick {
			display: flex;
			gap: 10px;
			margin-top: 12px
		}

		.quick .btn {
			flex: 1;
			background: #ffeddc;
			border-radius: 10px;
			padding: 14px;
			text-align: center;
			color: #b65a2f
		}

		@media(max-width:900px) {
			.layout {
				grid-template-columns: 1fr
			}
		}
	</style>
</head>

<body>
	<div class="app">
		<aside class="sidebar">
			<div class="brand">Faculty Management</div>
			<ul class="nav">
				<li>Dashboard</li>
				<li>Faculty</li>
				<li>Assign Load</li>
				<li>Course</li>
				<li>Schedule</li>
				<li>Department</li>
				<li>Reports</li>
			</ul>
			<div class="logout">Log Out</div>
		</aside>

		<main class="main">
			<div class="header">
				<div>
					<div class="subtle">Overview</div>
					<div class="welcome">Welcome Back, <?php echo htmlspecialchars($username); ?>!</div>
				</div>
				<div style="text-align:right">
					<div><?php echo htmlspecialchars($username); ?> <div style="font-size:12px;color:#a46a45"><?php echo $role; ?></div>
					</div>
				</div>
			</div>

			<div class="cards">
				<div class="card">
					<h3>Total Faculty</h3>
					<div class="num">45</div>
				</div>
				<div class="card">
					<h3>Total Courses</h3>
					<div class="num">34</div>
				</div>
				<div class="card">
					<h3>Total Sections</h3>
					<div class="num">51</div>
				</div>
			</div>

			<div class="layout">
				<div>
					<div class="panel roles">
						<h4 style="margin:0 0 10px 0;color:#b65a2f">Faculty Roles Distribution</h4>
						<div style="height:28px;background:#d8efe0;border-radius:18px;width:80%;margin-top:8px"></div>
						<div style="margin-top:12px;color:#a97464">Department Head • 2 &nbsp;&nbsp; Faculty Members • 20</div>
					</div>

					<div class="panel employment" style="margin-top:18px">
						<h4 style="margin:0 0 8px 0;color:#b65a2f">Faculty Employment</h4>
						<div class="row">
							<div>Full-Time</div>
							<div>25 Instructors</div>
						</div>
						<div class="progress" style="margin-bottom:12px"><i style="width:60%"></i></div>
						<div class="row">
							<div>Part-Time</div>
							<div>10 Instructors</div>
						</div>
						<div class="progress"><i style="width:30%"></i></div>
					</div>

					<div class="panel" style="margin-top:18px">
						<h4 style="margin:0 0 8px 0;color:#b65a2f">Workload Status & Monitoring</h4>
						<table>
							<thead>
								<tr>
									<th>Faculty Name</th>
									<th>Required Load</th>
									<th>Assigned Load</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Leah V. Barbaso</td>
									<td>18</td>
									<td>22</td>
									<td style="color:#c24a3a">Overloaded</td>
								</tr>
								<tr>
									<td>Kenn Migan Vincent C. Gumanon</td>
									<td>18</td>
									<td>24</td>
									<td style="color:#c24a3a">Overloaded</td>
								</tr>
								<tr>
									<td>Jasmine A. Tulin</td>
									<td>18</td>
									<td>24</td>
									<td style="color:#c24a3a">Overloaded</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

				<aside class="stats">
					<div class="panel calendar">
						<div>Calendar (placeholder)</div>
					</div>

					<div class="panel">
						<h4 style="margin:0 0 8px 0;color:#b65a2f">Assignment Overview</h4>
						<table>
							<thead>
								<tr>
									<th>Course</th>
									<th>Faculty</th>
									<th>Units</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>IT228</td>
									<td>Sayson</td>
									<td>3</td>
								</tr>
								<tr>
									<td>CSIT238</td>
									<td>Bacalso</td>
									<td>3</td>
								</tr>
								<tr>
									<td>CSIT226</td>
									<td>Barbaso</td>
									<td>3</td>
								</tr>
								<tr>
									<td>CSIT212</td>
									<td>Contreras</td>
									<td>3</td>
								</tr>
								<tr>
									<td>CSIT284</td>
									<td>Revilleza</td>
									<td>1</td>
								</tr>
							</tbody>
						</table>
					</div>

					<div class="panel" style="text-align:center">
						<h4 style="margin:0 0 8px 0;color:#b65a2f">Quick Actions</h4>
						<div class="quick">
							<div class="btn">Assign Course</div>
							<div class="btn">Add Faculty</div>
							<div class="btn">View Conflicts</div>
						</div>
					</div>
				</aside>
			</div>
		</main>
	</div>
</body>

</html>