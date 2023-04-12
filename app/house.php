<?php
if (isset($_GET['id'])) {
    require('db.php');
    $sql = 'SELECT `house`.*, `landlord`.`name` as `landlord_name`, `landlord`.`email` as `landlord_email`, `landlord`.`phone` as `landlord_phone` 
            FROM `house`
            LEFT JOIN `landlord` ON `landlord`.`id` = `house`.`landlord`
            WHERE `house`.`id` = :id AND  `house`.`enable` = 1';
    $sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array('id' => $_GET['id']));
    $house = $sth->fetch();
    if (!$house) {
        header("location:index.php");
    }
    $house['images'] = json_decode($house['images'], true);
    $house['rent'] = '$' . number_format($house['rent']);
} else {
    header("location:index.php");
}