<?php
include "configUpload.php";
$fileType = pathinfo($_FILES['uploadedFile']['full_path'], PATHINFO_EXTENSION);
$fileSize = $_FILES["uploadedFile"]["size"];
$fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
$fileName = uniqid('', true) . '_' . md5(uniqid(rand(), true)) . ".$fileType";

if (!isset($_FILES['uploadedFile']) or $_FILES['uploadedFile']['error'] != 0) {
    $message = "مشکلی در بارگذاری فایل وجود دارد, لطفا فایل خود را دوباره آپلود کنید";
    message($message, "uploadError", "index.php");
}
function message(string $message, string $sessionName, string $location)
{
    $_SESSION["$sessionName"] = $message;
    header("Location: $location");
    exit();
}

function checkFileType(string $fileType, array $allowedFileTypes): bool
{
    if (in_array($fileType, $allowedFileTypes)) return true;
    return false;
}

function checkFileSize(string $fileSize, int $maxFileSize): bool
{
    if ($fileSize > $maxFileSize) {
        return false;
    }
    return true;
}

function uploadFile(string $fileTmpPath, string $uploadPath, string $fileName): bool
{
    if (!move_uploaded_file($fileTmpPath, $uploadPath . $fileName)) {
        return false;
    }
    return true;
}

if (!checkFileType($fileType, $allowedFileTypesWithoutDot)) {
    $message = " را مد نظر قرار دهید " . $allowedFileTypesWithoutDotString . " فایل قابل آپلود نیست. لطفا تایپ های";
    message($message, "uploadError", "index.php");

}
if (!checkFileSize($fileSize, $maxFileSize)) {
    $message = " حداکثر مقدار مجاز " . $maxFileSize / 1000000 . " مگابایت است ";
    message($message, "uploadError", "index.php");
}

if (!uploadFile($fileTmpPath, $uploadPath, $fileName)) {
    $message = "آپلود به دلایلی موفقیت آمیز نبود, لطفا دوباره تلاش کنید";
    message($message, "uploadError", "index.php");
}
$fileLink = $root . $uploadPath . $fileName;
$_SESSION["fileLink"] = $fileLink;
$message = <<<TEXT
    <span class="message">آپلود با موفقیت انجام شد</span>
    <a download href="{$fileLink}" target="_blank" class="downloadFileLink">برای دانلود کلیک کنید</a>
        <button type="button" id="previewButton">برای مشاهده کلیک کنید</button>

TEXT;
message($message, "uploadSuccess", "index.php");
