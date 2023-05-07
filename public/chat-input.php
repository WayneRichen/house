<?php
session_start();
if (empty($_POST['content']) || empty($_POST['to_message']) || empty($_SESSION['user_id']) || $_SESSION['user_type'] == 'landlord') {
    header("location:index.php");
    exit;
}
require('../app/db.php');
$sql = 'INSERT INTO `chat` (`tenant_id`, `landlord_id`, `message_from`, `message_to`, `content`) VALUES (:tenant_id, :landlord_id, :message_from, :message_to, :content);';
$sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$sth->execute(array('tenant_id' => $_SESSION['user_id'], 'landlord_id' => $_POST['to_message'], 'message_from' => 'tenant', 'message_to' => 'landlord', 'content' => $_POST['content']));