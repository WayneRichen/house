<?php
session_start();
require('db.php');
$success = false;
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['content'])) {
    try {
        $sql = "INSERT INTO `suggest` (`name`, `email`, `content`) VALUES
                (:name, :email, :content)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['name' => $_POST['name'], 'email' => $_POST['email'], 'content' => $_POST['content']]);
        $success = true;
    } catch (PDOException $e) {
        $alert = $e->getMessage();
    }
}