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

    public static function getAllUsers()
    {
        $bd = Conectar::conexion();
        $q = "SELECT * FROM user";
        $result = $bd->query($q);
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = new User($row);
        }

        return $users;
    }

    public static function changeRol($user_id, $rol)
    {
        $bd = Conectar::conexion();
        $q = "UPDATE user SET rol=" . $rol . " WHERE id=" . $user_id;
        $bd->query($q);
    }
}
