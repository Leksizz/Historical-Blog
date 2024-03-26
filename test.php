<?php

const DB_USER = 'root';
const DB_PASS = '';
const DB_HOST = 'localhost';
const DB_NAME = 'blog';

$db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

$email = 'flex1234@mail.ru';
$sql = "SELECT * FROM users WHERE email = :email";
$stmt = $db->prepare($sql);
$stmt->execute([
    'email' => $email
]);
$user = $stmt->fetchAll(PDO::FETCH_ASSOC);

var_dump($user);

if ($user) {
    echo 123;
}