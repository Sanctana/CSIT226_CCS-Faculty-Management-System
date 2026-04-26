<?php

if (!isset($pageTitle)) {

    // get current file name (example: managementsection)

    /* $_SERVER['PHP_SELF'] -> pangitaon niya if asa ka na file currently nag open this includes full path inside project
     thats the time you use basename() to cut everything except sa filename so ex. managementsystem.php */
    $currentPage = basename($_SERVER['PHP_SELF'], ".php"); // removing the .php extension (optional rani)
                                                                // cleaner keys
    /* $currentPage = ex. managementsection (w .php removed)
     so $pageMap will make it to "Section Management"
            basically converting file name to readable page for the UI
                */
    // list of pages and their display names
    $pageMap = array(
            "dashboard" => "Dashboard",
            "managementsection" => "Section Management",
            "sectionregistration" => "Section Registration",
            "faculty" => "Faculty Management",
            "registerfaculty" => "Faculty Registration",
            "schedulemanagement" => "Schedule Management",
            "registerschedule" => "Schedule Registration",
            "workloadassignment" => "Workload Assignment",
            "coursemanagement" => "Course Management",
            "courseregistration" => "Course Registration"
    );

}

?>

<!-- top bar -->
<header class="top-bar">

    <!-- dynamic breadcrumb -->
    <div class="breadcrumb">
        Academic Management / <span><?php echo $pageTitle; ?></span>
    </div>

    <div class="header-right-group">
        <div class="semester-pill">
            <div class="live-dot"></div>
            2nd Semester, AY 2023-2024
        </div>

        <div class="profile-trigger">
            <div class="user-text">
                <span class="user-name">Cherry Lyn Sta. Romana</span>
                <span class="user-role">CS Department Head</span>
            </div>

            <div class="avatar"
                 style="background: url('https://ui-avatars.com/api/?name=Cherry+Sta+Romana&background=f47b20&color=fff');
                        background-size: cover;">
            </div>
        </div>
    </div>

</header>