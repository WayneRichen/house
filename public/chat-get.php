<?php
session_start();
if (empty($_POST['tenant_id']) || empty($_POST['landlord_id'])) {
    header("location:index.php");
    exit;
}
require('../app/db.php');
$sql = 'SELECT `chat`.*, `landlord`.`name` as `landlord_name` FROM `chat`
    JOIN `landlord` ON `landlord`.`id` = `chat`.`landlord_id`
    WHERE `chat`.`tenant_id` = :tenant_id AND `chat`.`landlord_id` = :landlord_id;';
$sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$sth->execute(array('tenant_id' => $_POST['tenant_id'], 'landlord_id' => $_POST['landlord_id']));
$messages = $sth->fetchAll();
echo json_encode($messages);