<?php
include "configUpload.php";
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Uploader</title>
    <link rel="stylesheet" href="assets/css/style.css">


</head>
<body>
<?php if(isset($_SESSION["uploadError"])): ?>
<div class="red_error">
<?= $_SESSION["uploadError"]?>
</div>
<?php endif; ?>
<?php if(isset($_SESSION["uploadSuccess"])): ?>
    <div class="green_success">
        <?= $_SESSION["uploadSuccess"]?>
    </div>
<?php endif; ?>
<div class="container">
    <form method="POST" action="upload.php" enctype="multipart/form-data">
        <div class="upload-wrapper">
            <span class="file-name">choose a file (<?= $allowedFileTypesWithoutDotString ?>)</span>
            <label for="file-upload">Browse
                <input type="file" id="file-upload" name="uploadedFile" accept="<?= $allowedFileTypesSting ?>">
            </label>
        </div>
        <input type="submit" name="uploadBtn" value="Upload"/>
    </form>
</div>
</body>
</html>
<?php session_unset() ?>