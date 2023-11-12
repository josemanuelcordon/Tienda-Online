<?php
class UserRepository
{
    public static function checkLogin($username, $password)
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM user WHERE username='" . $username . "' AND password='" . md5($password) . "'";
        $result = $bd->query($q);
        $data = $result->fetch_assoc();
        if ($result->num_rows > 0) {
            return new User($data);
        }
        return null;
    }

    public static function registerUser($username, $password, $address)
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM user WHERE username='" . $username . "'";
        $result = $bd->query($q);
        $success = true;
        if ($result->num_rows > 0) {
            $success = false;
        } else {
            $q = "INSERT INTO user VALUES (NULL, '" . $username . "', '" . md5($password) . "', 1, '" . $address . "')";
            $bd->query($q);
        }
        return $success;
    }
}
