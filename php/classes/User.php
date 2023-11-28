<?php

namespace classes;
class User
{
    public static function handlerReg()
    {
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $login = $_POST['login'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = password_hash($password, PASSWORD_DEFAULT);
        global $mysqli;
        $result = $mysqli->query("SELECT * FROM users WHERE email ='$email'");
        if ($result->num_rows) {
            return json_encode(["result" => "error"]);
        } else {
            $mysqli->query("INSERT INTO `users`(`name`, `lastname`, `login`, `email`, `password`) VALUES ('$name', '$lastname', '$login','$email','$password')");
            return json_encode(["result" => "success"]);
        }
    }

    public static function handlerLogin()
    {
        $login = $_POST['login'];
        $password = $_POST['password'];
        global $mysqli;
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $result = $mysqli->query("SELECT * FROM users where email='$login'");
        } else {
            $result = $mysqli->query("SELECT * FROM users where login='$login'");
        }
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc(); // Преобразуем ответ от БД в массив, где ключи массива = названия столбцов
            if (password_verify($password, $row['password'])) {
                $_SESSION['name'] = $row['name'];
                $_SESSION['lastname'] = $row['lastname'];
                $_SESSION['login'] = $row['login'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['id'] = $row['id'];
                echo json_encode(["result" => "success"]);
            } else {
                return json_encode(["result" => "error"]);
            }
        } else {
            return json_encode(["result" => "error"]);
        }
    }

    public static function getUserData()
    {
        return json_encode($_SESSION);
    }

    public static function logout()
    {
        session_destroy();
        header("Location: /login");
    }
}