<?php
include 'connections/connect.php';
require_once 'assets/includes/sidebar.php';

$pageTitle = "Section Management";
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CCS | Section Management</title>


<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet" href="assets/css/sidebar.css">
<link rel="stylesheet" href="assets/css/topbar.css">
<link rel="stylesheet" href="assets/css/variables.css">
<link rel="stylesheet" href="assets/css/components.css">



<div class="main-wrapper">
    <!-- top bar -->
    <?php require_once 'assets/includes/topbar.php'; ?>
    <!-- body content -->
    <main class="content-body">
        <div class="container">
            <div class="record-panel">
                <div class="record-header">
                    <div>
                        <div class="record-title">Section Management</div>
                        <div class="record-subtitle">Manage and view all sections</div>
                    </div>
                    <a href="registersection.php" class="add-btn">+ Add Section</a>
                </div>

                <div class="search-bar">
                    <input type="text" class="search-input" id="section-search" placeholder="Search by section name or year level...">
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Section Name</th>
                            <th>Year Level</th>
                            <th>Program</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody id="section-table-body">
                        <?php
                        $sql = "SELECT s.sectionname, s.yearlevel, p.programname, s.sectionid
                                FROM tblsection s
                                JOIN tblprogram p ON s.programid = p.programid";
                        $result = mysqli_query($connection, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>{$row['sectionname']}</td>";
                            echo "<td>{$row['yearlevel']}</td>";
                            echo "<td>{$row['programname']}</td>";
                            // TODO: Plan on what to do on these actions later
                            echo "<td>
                                    <a class='btn-edit' style='text-decoration: none;'>Edit</a>
                                    <span class='action-sep'>|</span>
                                    <a class='btn-delete'>Delete</a>
                                  </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const input = document.getElementById('section-search');
        const tbody = document.getElementById('section-table-body');
        let timer = null;

        async function doSearch(q) {
            try {
                const res = await fetch(`api/search_section.php?q=${encodeURIComponent(q)}`);
                if (!res.ok) throw new Error('Network error');
                tbody.innerHTML = await res.text();
            } catch (err) {
                console.error(err);
            }
        }

        input.addEventListener('input', (e) => {
            const q = e.target.value.trim();
            clearTimeout(timer);
            timer = setTimeout(() => doSearch(q), 300); // 300ms debounce
        });
    });
</script>