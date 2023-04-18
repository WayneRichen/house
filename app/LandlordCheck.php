<?php
class LandlordCheck {
    function __construct() {
        session_start();
        if (!isset($_SESSION['user_name']) || !isset($_SESSION['user_type']) || !isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'landlord') {
            header("location: index.php");
            exit;
        }
    }
}