<?php
$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;
define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
require APP_PATH . 'LandlordCheck.php';
$check = new LandlordCheck();

$isImage = getimagesize($_FILES['file']['tmp_name']);
if(!$isImage) {
    echo json_encode(['status' => 'fail'], true);
    exit;
}

define('UPLOAD_PATH', $root . 'public/upload/images/'.$_SESSION['user_id'] . DIRECTORY_SEPARATOR);
if (!is_dir(UPLOAD_PATH)) {
    mkdir(UPLOAD_PATH, 0777, true);
}
if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['file']['tmp_name'];
    $fileExt = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $fileName = uniqid('', true) . '.' . $fileExt;
    $filePath = '/upload/images/'.$_SESSION['user_id'].'/';
    $dest = UPLOAD_PATH . $fileName;
    move_uploaded_file($file, $dest);
    $fileUploadPath = $filePath . $fileName;
    echo json_encode(['status' => 'success', 'file' => $fileUploadPath], true);
    exit;
} else {
    $alert = '圖片上傳失敗：' . $_FILES['file']['error'];
    echo json_encode(['status' => 'fail'], true);
}