<?php
require 'CreateHouse.php';
class EditHouse extends CreateHouse {
    function __construct() {
        parent::__construct();
        require('db.php');
        $this->conn = $conn;
        $this->title = isset($_POST['title']) ? trim($_POST['title']) : '';
        $this->subtitle = isset($_POST['subtitle']) ? trim($_POST['subtitle']) : '';
        $this->region = isset($_POST['region']) ? trim($_POST['region']) : '';
        $this->rent = isset($_POST['rent']) ? (int)trim($_POST['rent']) : '';
        $this->vr_url = isset($_POST['vr_url']) ? trim($_POST['vr_url']) : '';
        $this->description = isset($_POST['description']) ? $_POST['description'] : '';
        $this->house_img = isset($_POST['house_img']) ? trim($_POST['house_img']) : '[]';
        $this->house_id = isset($_GET['id']) ? $_GET['id'] : '';
    }

    public function process() {
        $inputError = $this->checkInput();
        if ($inputError) {
            return $inputError;
        }
        $updateError = $this->updateHouse();
        if ($updateError) {
            return $updateError;
        }
    }

    public function getHouse() {
        if ($this->house_id == '') {
            header("location: create-house.php");
            exit;
        }

        $sql = 'SELECT *
                FROM house
                WHERE `id` = :id AND `enable` = 1';
        $sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array('id' => $_GET['id']));
        $house = $sth->fetch();
        if (!$house || $house['landlord'] != $_SESSION['user_id']) {
            header("location: create-house.php");
            exit;
        }
        $house['images'] = json_decode($house['images'], true);
        return $house;
    }

    public function updateHouse() {
        try {
            $sql = "UPDATE `house` 
                SET `title`=:title, 
                    `subtitle`=:subtitle, 
                    `city`=:city, 
                    `region`=:region, 
                    `rent`=:rent, 
                    `vr_url`=:vr_url, 
                    `description`=:description, 
                    `images`=:images 
                    WHERE `id`=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'title' => $this->title,
                'subtitle' => $this->subtitle,
                'city' => '',
                'region' => $this->region,
                'rent' => $this->rent,
                'vr_url' => $this->vr_url,
                'description' => $this->description,
                'images' => json_encode([$this->house_img], true),
                'id' => $this->house_id]);
            header("Refresh: 0; url=house-manage.php");
            exit;
        } catch (PDOException $e) {
            $alert = $e->getMessage();
            return $alert;
        }
    }
}