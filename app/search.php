<?php
if (isset($_GET['region'])) {
    require('db.php');
    $sql = 'SELECT *
            FROM house
            WHERE `region` LIKE :region AND `enable` = 1';
    $sth = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array('region' => '%' . $_GET['region'] . '%'));
    $houses = $sth->fetchAll();
    if (count($houses) > 0) {
        foreach ($houses as $key => $house) {
            $houses[$key]['images'] = json_decode($house['images'], true);
            $houses[$key]['rent'] = '$' . number_format($house['rent']);
        }
    }
}