<?php
session_start();
if (empty($_GET['house_id']) || empty($_SESSION['user_id']) || $_SESSION['user_type'] == 'landlord') {
    echo"<script>history.go(-1);</script>";
    exit;
}
require('../app/db.php');
$sql = 'SELECT `house`.*, `landlord`.`name` as `landlord_name`, `landlord`.`email` as `landlord_email`, `landlord`.`phone` as `landlord_phone` 
            FROM `house`
            LEFT JOIN `landlord` ON `landlord`.`id` = `house`.`landlord`
            WHERE `house`.`id` = :id AND  `house`.`enable` = 1';
$sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$sth->execute(array('id' => $_GET['house_id']));
$house = $sth->fetch();
if (!$house) {
    echo"<script>history.go(-1);</script>";
    exit;
}
$sql = 'SELECT * FROM `collection` WHERE `collection`.`tenant_id` = :tenant_id AND `collection`.`house_id` = :house_id';
$sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$sth->execute(array('tenant_id' => $_SESSION['user_id'], 'house_id' => $_GET['house_id']));
$collection = $sth->fetch();
if ($collection) {
    try {
        $sql = 'DELETE FROM `collection` WHERE `collection`.`id` = :collection_id;';
        $sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array('collection_id' => $collection['id']));
        echo"<script>alert('已從收藏清單移除');history.go(-1);</script>";
        exit;
    } catch(PDOException $e) {
        $alert = $e->getMessage();
        echo"<script>alert(`$alert`);history.go(-1);</script>";
        exit;
    }
} else {
    try {
        $sql = 'INSERT INTO `collection` (`tenant_id`, `house_id`) VALUES (:tenant_id, :house_id);';
        $sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array('tenant_id' => $_SESSION['user_id'], 'house_id' => $_GET['house_id']));
        echo"<script>alert('已收藏');history.go(-1);</script>";
        exit;
    } catch (PDOException $e) {
        $alert = $e->getMessage();
        echo"<script>alert(`$alert`);history.go(-1);</script>";
        exit;
    }
}