<?php
require 'LandlordCheck.php';
$landLordCheck = new LandlordCheck();

require('db.php');
$sql = 'SELECT *
        FROM house
        WHERE `landlord` = :landlord AND `enable` = 1';
$sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$sth->execute(array('landlord' => $_SESSION['user_id']));
$houses = $sth->fetchAll();
if (count($houses) > 0) {
    foreach ($houses as $houseIndex => $house) {
        $houses[$houseIndex]['images'] = json_decode($house['images'], true);
    }
}