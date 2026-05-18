<?php
include 'connections/connect.php';

$isEditMode = false;
$sectionId = 0;
$sectionname = '';
$yearlevel = '';
$programid = '';
$errorMessage = '';

if (isset($_GET['sectionid']) && ctype_digit($_GET['sectionid'])) {
    $sectionId = (int) $_GET['sectionid'];

    if ($sectionId > 0) {
        $stmt = $connection->prepare("SELECT sectionname, yearlevel, programid FROM tblsection WHERE sectionid = ? LIMIT 1");
        if ($stmt) {
            $stmt->bind_param("i", $sectionId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                $isEditMode = true;
                $sectionname = $row['sectionname'];
                $yearlevel = $row['yearlevel'];
                $programid = $row['programid'];
            } else {
                $errorMessage = 'Section not found.';
            }
            $stmt->close();
        } else {
            $errorMessage = 'Failed to load section: ' . $connection->error;
        }
    }
}

$pageTitle = $isEditMode ? 'Edit Section' : 'Section Registration';
$formTitle = $isEditMode ? 'Edit Section' : 'Section Registration';
$submitLabel = $isEditMode ? 'Update Section' : 'Register Section';
$formType = $isEditMode ? 'section_update' : 'section_registration';

require_once 'assets/includes/sidebar.php';
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CCS | Section Registration</title>


<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet" href="assets/css/sidebar.css">
<link rel="stylesheet" href="assets/css/topbar.css">
<link rel="stylesheet" href="assets/css/variables.css">
<link rel="stylesheet" href="assets/css/components.css">
<link rel="stylesheet" href="assets/css/formtemplate.css">
<link rel="stylesheet" href="assets/css/registerLoad.css">

<div class="main-wrapper">

    <?php require_once 'assets/includes/topbar.php'; ?>

    <main class="content-body">
        <div class="container">
            <div class="form-panel">
                <div class="form-header">
                    <a href="managementsection.php" class="back-icon">
                        <img src="assets/img/back.png" alt="Back">
                    </a>
                    <h2><?php echo htmlspecialchars($formTitle); ?></h2>

                </div>

                <div class="form-divider"></div>

                <?php if ($errorMessage !== ''): ?>
                    <div id="sectionError" class="record-subtitle" style="color: #b42318; margin-bottom: 12px;">
                        <?php echo htmlspecialchars($errorMessage); ?>
                    </div>
                <?php else: ?>
                    <div id="sectionError" class="record-subtitle" style="color: #b42318; margin-bottom: 12px; display: none;"></div>
                <?php endif; ?>

                <form method="post">
                    <input type="hidden" name="form_type" value="<?php echo htmlspecialchars($formType); ?>">
                    <?php if ($isEditMode): ?>
                        <input type="hidden" name="section_id" value="<?php echo (int) $sectionId; ?>">
                    <?php endif; ?>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Section Name</label>
                            <input type="text" name="sectionname" class="form-input" value="<?php echo htmlspecialchars((string) $sectionname); ?>" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Year Level</label>
                            <select name="yearlevel" class="form-select" required>
                                <option value="">Select Year Level</option>
                                <option value="1" <?php echo ((string) $yearlevel === '1') ? 'selected' : ''; ?>>1st Year</option>
                                <option value="2" <?php echo ((string) $yearlevel === '2') ? 'selected' : ''; ?>>2nd Year</option>
                                <option value="3" <?php echo ((string) $yearlevel === '3') ? 'selected' : ''; ?>>3rd Year</option>
                                <option value="4" <?php echo ((string) $yearlevel === '4') ? 'selected' : ''; ?>>4th Year</option>
                            </select>
                        </div>

                        <div class="form-group">

                            <!--Reworked Program Form to show all programs within tblprogram (feel free to change kung hassle ra kaayo)  -->
                            <label class="form-label">Program</label>

                            <!-- uses programid instead to display program names based on program ID (more efficient but can be reverted back if too much na) -->
                            <select name="programid" class="form-select" required>
                                <?php
                                $result = mysqli_query($connection, "SELECT programid, programname FROM tblprogram");
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $programValue = htmlspecialchars((string) $row['programid'], ENT_QUOTES, 'UTF-8');
                                    $programName = htmlspecialchars((string) $row['programname']);
                                    $selected = ((string) $programid === (string) $row['programid']) ? ' selected' : '';
                                    echo "<option value=\"{$programValue}\"{$selected}>{$programName}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <input type="submit" name="btnRegister" value="<?php echo htmlspecialchars($submitLabel); ?>" class="form-submit">
                </form>
            </div>
        </div>
    </main>

</div>

<div id="confirmOverlay" class="confirm-overlay" aria-hidden="true">
    <div class="confirm-modal" role="dialog" aria-modal="true" aria-labelledby="confirmTitle">
        <div class="confirm-header" id="confirmTitle">Confirm Section Details</div>
        <div class="confirm-body">
            <p>Review the details before saving.</p>
            <ul id="confirmList" class="confirm-list"></ul>
        </div>
        <div class="confirm-actions">
            <button type="button" id="confirmCancel" class="confirm-btn cancel">Cancel</button>
            <button type="button" id="confirmOk" class="confirm-btn primary">Confirm</button>
        </div>
    </div>
</div>

<script src="assets/js/registersection.js" defer></script>

<!-- save section info to DB-->
<?php
if (isset($_POST['form_type']) && in_array($_POST['form_type'], ['section_registration', 'section_update'], true)) {
    $formType = $_POST['form_type'];
    $postedSectionId = isset($_POST['section_id']) && ctype_digit($_POST['section_id']) ? (int) $_POST['section_id'] : 0;

    $sectionname = trim($_POST['sectionname'] ?? '');
    $yearlevel = (int) ($_POST['yearlevel'] ?? 0);
    $programid = (int) ($_POST['programid'] ?? 0);

    $isSaved = false;

    if ($formType === 'section_update' && $postedSectionId > 0) {
        $isEditMode = true;
        $sectionId = $postedSectionId;

        $stmt = $connection->prepare("UPDATE tblsection SET sectionname = ?, yearlevel = ?, programid = ? WHERE sectionid = ?");
        if ($stmt) {
            $stmt->bind_param("siii", $sectionname, $yearlevel, $programid, $sectionId);
            $isSaved = $stmt->execute();
            if (!$isSaved) {
                $errorMessage = 'Failed to save section: ' . $stmt->error;
            }
            $stmt->close();
        } else {
            $errorMessage = 'Failed to save section: ' . $connection->error;
        }
    } else {
        $isEditMode = false;

        $stmt = $connection->prepare("INSERT INTO tblsection (sectionname, yearlevel, programid) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sii", $sectionname, $yearlevel, $programid);
            $isSaved = $stmt->execute();
            if (!$isSaved) {
                $errorMessage = 'Failed to save section: ' . $stmt->error;
            }
            $stmt->close();
        } else {
            $errorMessage = 'Failed to save section: ' . $connection->error;
        }
    }

    if ($isSaved) {
        echo "<script>window.location.href='managementsection.php';</script>";
        exit();
    }

    if ($errorMessage === '') {
        $errorMessage = 'Failed to save section.';
    }

    $encodedError = json_encode($errorMessage, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    echo "<script>(function(){var el=document.getElementById('sectionError');if(el){el.textContent={$encodedError};el.style.display='block';}})();</script>";
}

?>