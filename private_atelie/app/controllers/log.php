<?php
session_start();

require('../database/connect.php');

$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
$phonenumber = trim(filter_var($_POST['phonenumber'], FILTER_SANITIZE_SPECIAL_CHARS));
$pass = trim(filter_var($_POST['passfirst'], FILTER_SANITIZE_SPECIAL_CHARS));

if (empty($phonenumber) || empty($email) || empty($pass)) {
    echo 'Заполните все поля';
    exit;
} else {


    $mysql = "SELECT * FROM `clients` WHERE `email` = ? AND `phone_num` = ?";
    $query = $pdo->prepare($mysql);
    $query->execute([$email, $phonenumber]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if(password_verify($pass, $user['passwd'])) {
            $_SESSION['clientID'] = $user['clientID'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['third_name'] = $user['third_name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['phone_num'] = $user['phone_num'];

            header('Location: ../../user.php');
            exit;
        }
    }

    $mysql = "SELECT * FROM `employee` WHERE `email` = ? AND `phone_num` = ?";
    $query = $pdo->prepare($mysql);
    $query->execute([$email, $phonenumber]);
    $employee = $query->fetch(PDO::FETCH_ASSOC);

    if ($employee) {
        if(password_verify($pass, $employee['passwd'])) {
            $_SESSION['employeeID'] = $employee['employeeID'];
            $_SESSION['first_name'] = $employee['first_name'];
            $_SESSION['last_name'] = $employee['last_name'];
            $_SESSION['third_name'] = $employee['third_name'];
            $_SESSION['email'] = $employee['email'];
            $_SESSION['phone_num'] = $employee['phone_num'];

            header('Location: ../../user.php');
            exit;
        }
    }
    $error = "проверьте данные на правильность";
    echo $error;
}
?>