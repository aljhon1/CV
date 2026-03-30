<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Please submit the form first.");
}

$name = htmlspecialchars($_POST['name'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');
$phone = htmlspecialchars($_POST['phone'] ?? '');
$hobby = htmlspecialchars($_POST['hobby'] ?? '');
$objective = htmlspecialchars($_POST['objective'] ?? '');
$education = htmlspecialchars($_POST['education'] ?? '');
$skills = htmlspecialchars($_POST['skills'] ?? '');

// Upload folder
$targetDir = "uploads/";
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

$imagePath = "";

if (isset($_FILES["profile"]) && $_FILES["profile"]["error"] == 0) {
    $fileName = time() . "_" . basename($_FILES["profile"]["name"]);
    $targetFile = $targetDir . $fileName;
    move_uploaded_file($_FILES["profile"]["tmp_name"], $targetFile);
    $imagePath = $targetFile;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My CV</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="cv">

    <!-- LEFT SIDE -->
    <div class="left">

        <?php if ($imagePath): ?>
            <img src="<?php echo $imagePath; ?>" class="profile">
        <?php else: ?>
            <div class="profile"></div>
        <?php endif; ?>

        <h2><?php echo $name; ?></h2>

        <!-- CONTACT -->
        <div class="section">
            <h3>Contact</h3>
            <p><?php echo $email; ?></p>
            <p><?php echo $phone; ?></p>
        </div>

        <!-- HOBBY UNDER CONTACT -->
        <div class="section">
            <h3>Hobby</h3>
            <p><?php echo $hobby; ?></p>
        </div>

    </div>

    <!-- RIGHT SIDE -->
    <div class="right">

        <div class="section">
            <h2>Objective</h2>
            <p><?php echo $objective; ?></p>
        </div>

        <div class="section">
            <h2>Education</h2>
            <p><?php echo nl2br($education); ?></p>
        </div>

        <div class="section">
            <h2>Skills</h2>
            <p><?php echo nl2br($skills); ?></p>
        </div>

    </div>

</div>

</body>
</html>