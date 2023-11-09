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
}
