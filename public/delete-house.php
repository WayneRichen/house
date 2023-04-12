<?php
$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;
define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
require APP_PATH . 'LandlordCheck.php';
$check = new LandlordCheck();
require APP_PATH . 'db.php';

$house_id = isset($_POST['id']) ? $_POST['id'] : '';
if ($house_id == '') {
    header("location: house-manage.php");
    exit;
}

$sql = 'SELECT *
        FROM house
        WHERE `id` = :id AND `enable` = 1';
$sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$sth->execute(array('id' => $house_id));
$house = $sth->fetch();
if (!$house || $house['landlord'] != $_SESSION['user_id']) {
    header("location: house-manage.php");
    exit;
}

try {
    $sql = 'UPDATE `house`
            SET `enable` = 0
            WHERE `house`.`id` = :id';
    $sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array('id' => $house_id));
    echo json_encode(['status' => 'success'], true);
} catch (PDOException $e) {
    echo json_encode(['status' => 'fail'], true);
}