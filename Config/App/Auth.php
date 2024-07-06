<?php

class Auth {
    public static function noAuth() {
        if (!isset($_SESSION['authenticated'])) {
            header('Location:' . base_url . '/login');
        }
    }
    
    public static function logout() {
        session_name("miniFrameworkPHP");
        session_start();
        session_destroy();
        $_SESSION = [];
        header('Location:' . base_url . '/login');
    }

    public static function validateSession() {
        if (!isset($_SESSION['user'])) {
            header('Location:' . base_url . '/login');
        } elseif ($_SESSION['authenticated']) {
            $lastSession = $_SESSION["lastAccess"];
            $currentTime = date("Y-n-j H:i:s");
            $differenceTime = (strtotime($currentTime) - strtotime($lastSession));
            if ($differenceTime >= 2500) {
                session_destroy();
                header('Location:' . base_url . '/login');
            } else {
                $_SESSION["lastAccess"] = $currentTime;
            }
        }
    }
}