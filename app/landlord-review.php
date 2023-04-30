<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header("location:login.php");
}
require('db.php');
$success = false;
if (isset($_POST['content']) && isset($_POST['landlord'])) {
    try {
        $sql = "INSERT INTO `landlord_review` (`landlord_id`, `tenant_id`, `content`) VALUES
                (:landlord_id, :tenant_id, :content)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['landlord_id' => $_POST['landlord'], 'tenant_id' => $_SESSION['user_id'], 'content' => $_POST['content']]);
        $success = true;
    } catch (PDOException $e) {
        $alert = $e->getMessage();
    }
}

$sql = 'SELECT landlord_review.*, landlord.name
        FROM landlord_review
        JOIN landlord ON landlord.id = landlord_review.landlord_id
        WHERE `tenant_id` = :tenant_id
        ORDER BY id DESC;
        ';
$sth = $conn->prepare($sql);
$sth->execute(array('tenant_id' => $_SESSION['user_id']));
$landlord_review = $sth->fetchAll();

$sql = 'SELECT *
        FROM landlord;
        ';
$sth = $conn->prepare($sql);
$sth->execute();
$landlords = $sth->fetchAll();