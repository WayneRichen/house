<?php
require('db.php');
session_start();
if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['type'])) {
    if ($_POST['type'] === 'tenant') {
        $sql = 'SELECT *
            FROM tenant
            WHERE `email` = :email AND `enable` = 1';
        $user_type = 'tenant';
    } elseif ($_POST['type'] === 'landlord') {
        $sql = 'SELECT *
            FROM landlord
            WHERE `email` = :email AND `enable` = 1';
        $user_type = 'landlord';
    }
    try {
        $sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array('email' => $_POST['email']));
        $user = $sth->fetch();
        if ($user) {
            if (password_verify($_POST['password'], $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_type'] = $user_type;
                if ($user_type === 'landlord') {
                    header("Refresh: 0; url=house-manage.php");
                    exit;
                }
                header("Refresh: 0; url=index.php");
                exit;
            }
        }
        $alert = "帳號密碼錯誤或帳號已停用";
    } catch (PDOException $e) {
        $alert = '系統錯誤，請稍後再試';
    }
} elseif (isset($_GET['logout'])) {
    session_destroy();
    header("location:index.php");
} elseif (isset($_SESSION['user_name'])) {
    header("location:index.php");
}