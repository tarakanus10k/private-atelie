<?php
require '../database/connect.php';

$firstname = trim(filter_var($_POST['firstname'], FILTER_SANITIZE_SPECIAL_CHARS));
$lastname = trim(filter_var($_POST['lastname'], FILTER_SANITIZE_SPECIAL_CHARS));
$thirdname = trim(filter_var($_POST['thirdname'], FILTER_SANITIZE_SPECIAL_CHARS));
$phonenumber = trim(filter_var($_POST['phonenumber'], FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS));
$passfirst = trim(filter_var($_POST['passfirst'], FILTER_SANITIZE_SPECIAL_CHARS));
$passsecond = trim(filter_var($_POST['passsecond'], FILTER_SANITIZE_SPECIAL_CHARS));

if(empty($firstname) || empty($lastname) || empty($thirdname) || empty($email) || empty($phonenumber) || empty($passfirst) || empty($passsecond)) {
    echo 'не все поля введены';
    exit;
} else {
    if($passfirst === $passsecond) {

        $passfirst = password_hash($passfirst, PASSWORD_DEFAULT);
    
        require '../database/connect.php';
    
        $mysql = 'INSERT INTO employee(first_name, last_name, third_name, email, phone_num, passwd) VALUES(?, ?, ?, ?, ?, ?)';
        $quary = $pdo->prepare($mysql);
        $quary->execute([$firstname, $lastname, $thirdname, $email, $phonenumber, $passfirst]);

        header('Location: ../../codethe.php');
    
    } else {
        echo '';
        exit;
    }
}
?>