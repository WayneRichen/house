<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header("location:index.php");
}
require('db.php');
$success = false;
if (isset($_POST['password']) || isset($_POST['name']) || isset($_POST['phone'])) {
    if ($_POST['password'] != '') {
        try {
            $sql = "UPDATE `tenant` 
                SET `name`=:name, 
                    `phone`=:phone,
                    `password`=:password
                WHERE `id`=:id";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                'name' => $_POST['name'],
                'phone' => $_POST['phone'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'id' => $_SESSION['user_id']]);
            $success = true;
        } catch (PDOException $e) {
            $alert = '更新失敗，請稍後再試！';
        }
    } else {
        try {
            $sql = "UPDATE `tenant` 
                SET `name`=:name, 
                    `phone`=:phone
                WHERE `id`=:id";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                'name' => $_POST['name'],
                'phone' => $_POST['phone'],
                'id' => $_SESSION['user_id']]);
            $success = true;
        } catch (PDOException $e) {
            $alert = '更新失敗，請稍後再試！';
        }
    }
}

$sql = 'SELECT *
        FROM tenant
        WHERE `id` = :id';
$sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$sth->execute(array('id' => $_SESSION['user_id']));
$user = $sth->fetch();
$_SESSION['user_name'] = $user['name'];