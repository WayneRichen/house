<?php
require 'LandlordCheck.php';
class CreateHouse extends LandlordCheck {
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
        $this->house_img = isset($_POST['house_img']) ? trim($_POST['house_img']) : '';
    }

    public function process() {
        $inputError = $this->checkInput();
        if ($inputError) {
            return $inputError;
        }
        $insertError = $this->insertHouse();
        if ($insertError) {
            return $insertError;
        }
    }

    public function checkInput() {
        if (empty($this->title)) {
            $alert = '標題未填寫';
            return $alert;
        }
        if (empty($this->subtitle)) {
            $alert = '副標題未填寫';
            return $alert;
        } 
        if (empty($this->region)) {
            $alert = '地區未填寫';
            return $alert;
        }
        if (empty($this->rent)) {
            $alert = '租金未填寫';
            return $alert;
        }
        if (empty($this->vr_url)) {
            $alert = 'VR 看房網址未填寫';
            return $alert;
        }
        if (empty($this->description)) {
            $alert = '房屋描述未填寫';
            return $alert;
        }
        if (empty($this->house_img)) {
            $alert = '房屋圖片未上傳';
            return $alert;
        }
    }

    public function insertHouse() {
        try {
            $sql = "INSERT INTO `house` (`landlord`, `title`, `subtitle`, `city`, `region`, `rent`, `vr_url`, `description`, `images`, `enable`) VALUES
                        (:landlord, :title, :subtitle, :city, :region, :rent, :vr_url, :description, :images, :enable)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['landlord' => $_SESSION['user_id'],
                'title' => $this->title,
                'subtitle' => $this->subtitle,
                'city' => '',
                'region' => $this->region,
                'rent' => $this->rent,
                'vr_url' => $this->vr_url,
                'description' => $this->description,
                'images' => json_encode([$this->house_img], true),
                'enable' => 1]);
            header("Refresh: 0; url=house-manage.php");
            exit;
        } catch (PDOException $e) {
            $alert = $e->getMessage();
            return $alert;
        }
    }
}