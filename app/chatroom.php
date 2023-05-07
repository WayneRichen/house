<?php
require('db.php');
if (empty($_SESSION['user_id']) || $_SESSION['user_type'] == 'landlord' || empty($_GET['to_message'])) {
    header("location:index.php");
    exit;
}
$sql = 'SELECT `chat`.*, `landlord`.`name` as `landlord_name` FROM `chat`
    JOIN `landlord` ON `landlord`.`id` = `chat`.`landlord_id`
    WHERE `chat`.`tenant_id` = :tenant_id AND `chat`.`landlord_id` = :landlord_id;';
$sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$sth->execute(array('tenant_id' => $_SESSION['user_id'], 'landlord_id' => $_GET['to_message']));
$messages = $sth->fetchAll();