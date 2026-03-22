<?php
// Static faculty page - generated statically
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	<title>Faculty Management</title>
	<style>
		:root {
			--peach: #ffd6c2;
			--peach-2: #ffc39b;
			--accent: #ff7a2d;
			--text: #3a3a3a
		}

		* {
			box-sizing: border-box
		}

		body {
			margin: 0;
			font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
			color: var(--text);
			background: #fff
		}

		/* Sidebar */
		.sidebar {
			position: fixed;
			left: 0;
			top: 0;
			bottom: 0;
			width: 220px;
			background: linear-gradient(180deg, var(--peach) 0%, #ffe9df 100%);
			padding: 28px 20px
		}

		.brand {
			color: white;
			font-weight: 600;
			margin-bottom: 28px
		}

		.nav-section {
			margin: 22px 0;
			color: rgba(0, 0, 0, 0.55)
		}

		.nav-item {
			display: flex;
			align-items: center;
			gap: 12px;
			padding: 10px 6px;
			border-radius: 6px;
			color: #3b3b3b
		}

		.nav-item .box {
			width: 18px;
			height: 18px;
			border: 2px solid rgba(0, 0, 0, 0.08);
			background: white;
			border-radius: 3px
		}

		.logout {
			position: absolute;
			bottom: 28px;
			left: 20px;
			color: rgba(0, 0, 0, 0.45)
		}

		/* Main area */
		.main {
			margin-left: 220px;
			padding: 18px 40px
		}

		.topbar {
			height: 64px;
			display: flex;
			align-items: center;
			justify-content: flex-end;
			padding: 0 20px
		}

		.topbar .user {
			display: flex;
			align-items: center;
			gap: 12px
		}

		.avatar {
			width: 44px;
			height: 44px;
			border-radius: 50%;
			background: #222
		}

		/* Table card */
		.card {
			margin-top: 20px;
			padding: 22px;
			border-radius: 14px;
			border: 1px solid rgba(255, 122, 45, 0.12);
			box-shadow: 0 8px 18px rgba(255, 122, 45, 0.12);
			background: linear-gradient(#fff, #fff)
		}

		.table-wrap {
			overflow: hidden
		}

		table.fancy {
			width: 100%;
			border-collapse: collapse;
			border-radius: 10px;
			overflow: hidden
		}

		table.fancy thead th {
			padding: 14px 12px;
			text-align: left;
			color: var(--accent);
			border-bottom: 2px solid rgba(255, 122, 45, 0.15)
		}

		table.fancy td {
			padding: 14px 12px;
			border-bottom: 1px solid rgba(255, 122, 45, 0.10)
		}

		table.fancy tr:last-child td {
			border-bottom: 0
		}

		table.fancy tr td:nth-child(1) {
			width: 40px
		}

		/* Responsive */
		@media (max-width:800px) {
			.sidebar {
				display: none
			}

			.main {
				margin-left: 0;
				padding: 16px
			}
		}
	</style>
</head>

<body>

	<aside class="sidebar">
		<div class="brand" style="color:#6b2b00">Faculty Management</div>

		<div class="nav-section">
			<div style="font-weight:700;margin-bottom:8px;color:#8f3a12">Dashboard</div>
			<div class="nav-item">
				<div class="box"></div> Home
			</div>
		</div>

		<div class="nav-section">
			<div style="font-weight:700;margin-bottom:8px;color:#8f3a12">FACULTY MANAGEMENT</div>
			<div class="nav-item">
				<div class="box"></div> Faculty
			</div>
			<div class="nav-item">
				<div class="box"></div> Assign Load
			</div>
		</div>

		<div class="nav-section">
			<div style="font-weight:700;margin-bottom:8px;color:#8f3a12">COURSE MANAGEMENT</div>
			<div class="nav-item">
				<div class="box"></div> Course
			</div>
			<div class="nav-item">
				<div class="box"></div> Schedule
			</div>
		</div>

		<div class="nav-section">
			<div style="font-weight:700;margin-bottom:8px;color:#8f3a12">DEPARTMENT</div>
			<div class="nav-item">
				<div class="box"></div> Department
			</div>
		</div>

		<div class="nav-section">
			<div style="font-weight:700;margin-bottom:8px;color:#8f3a12">REPORTS</div>
			<div class="nav-item">
				<div class="box"></div> Reports
			</div>
		</div>

		<div class="logout">Log Out</div>
	</aside>

	<main class="main">
		<div class="topbar">
			<div class="user">
				<div style="text-align:right;margin-right:8px">
					<div style="font-weight:700">Cherry Lyn Sta. Romana</div>
					<div style="font-size:12px;color:rgba(0,0,0,0.45)">CS Department Head</div>
				</div>
				<div class="avatar"></div>
			</div>
		</div>

		<section class="card">
			<div class="table-wrap">
				<table class="fancy" role="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Faculty Name</th>
							<th>Department</th>
							<th>Position</th>
							<th>Contact</th>
						</tr>
					</thead>
					<tbody>
						<?php
						// Static rows - replace with dynamic content when needed
						$rows = [
							['1', 'Cherry Lyn Sta. Romana', 'College of Computer Science', 'Department Head', '(0917) 000-0000'],
							['2', 'John Doe', 'College of Computer Science', 'Professor', '(0917) 111-1111'],
							['3', 'Jane Smith', 'College of Computer Science', 'Professor', '(0917) 222-2222'],
							['4', 'Alice Brown', 'College of Computer Science', 'Professor', '(0917) 333-3333'],
							['5', 'Bob White', 'College of Computer Science', 'Professor', '(0917) 444-4444'],
						];
						foreach ($rows as $r) {
							echo "<tr>";
							foreach ($r as $c) echo "<td>" . htmlspecialchars($c) . "</td>";
							echo "</tr>\n";
						}
						?>
					</tbody>
				</table>
			</div>
		</section>

	</main>

</body>

</html>