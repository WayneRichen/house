<?php
class Register {
    function __construct() {
        require('db.php');
        $this->conn = $conn;
        $this->type = $_POST['type'];
        $this->email = $_POST['email'];
        $this->password = $_POST['password'];
        $this->name = $_POST['name'];
        $this->phone = $_POST['phone'];
    }

    public function checkUser() {
        if (empty($this->type)) {
            $alert = '使用者類型未勾選';
            return $alert;
        }
        if (!in_array($this->type, ['landlord', 'tenant'])) {
            $alert = '無效的使用者類型';
            return $alert;
        } 
        if (empty($this->email)) {
            $alert = '電子郵件地址未填寫';
            return $alert;
        }
        if (empty($this->password)) {
            $alert = '密碼未填寫';
            return $alert;
        }
        if (empty($this->name)) {
            $alert = '姓名未填寫';
            return $alert;
        }
        if (empty($this->phone)) {
            $alert = '電話未填寫';
            return $alert;
        }
        if ($this->type === 'tenant') {
            $sql = 'SELECT *
                    FROM tenant
                    WHERE `email` = :email';
        } else {
            $sql = 'SELECT *
                FROM landlord
                WHERE `email` = :email AND `enable` = 1';
            }
        $sth = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array('email' => $_POST['email']));
        $user = $sth->fetch();
        if ($user) {
            $alert = '電子郵件地址已經存在';
            return $alert;
        }
    }

    public function insertUser() {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        if ($this->type === 'tenant') {
            $sql = "INSERT INTO `tenant` (`email`, `password`, `name`, `phone`, `enable`) VALUES
                (:email, :password, :name, :phone, 1)";
        } else {
            $sql = "INSERT INTO `landlord` (`email`, `password`, `name`, `phone`, `enable`) VALUES
                (:email, :password, :name, :phone, 1)";
        }
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email' => $this->email, 'password' => $this->password, 'name' => $this->name, 'phone' => $this->phone]);
            $userId = $this->conn->lastInsertId();
            $_SESSION['user_id'] = $userId;
            $_SESSION['user_name'] = $this->name;
            $_SESSION['user_type'] = $this->type;
            if ($this->type === 'landlord') {
                header("Refresh: 0; url=house-manage.php");
                exit;
            }
            header("Refresh: 0; url=index.php");
            exit;
        } catch (PDOException $e) {
            $alert = $e->getMessage();
            return $alert;
        }
    }
}