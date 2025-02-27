<?php
session_start();
require('../database/connect.php');

if(!isset($_SESSION['clientID'])) {
    echo 'ошибка';
    exit;
}

$categoryID = trim(filter_var($_POST['category'], FILTER_SANITIZE_SPECIAL_CHARS));
$serviceID = trim(filter_var($_POST['service'], FILTER_SANITIZE_SPECIAL_CHARS));
$dateID = trim(filter_var($_POST['odate'], FILTER_SANITIZE_SPECIAL_CHARS));

$clientID = $_SESSION['clientID'];

if(empty($categoryID) || empty($serviceID) || empty($dateID)) {
    echo 'ошибка';
    exit;
}

$mysql = "INSERT INTO corder(order_date, categoriesID, clientID, serviceID) VALUES (?, ?, ?, ?)";
$query = $pdo->prepare($mysql);
$query->execute([$dateID, $categoryID, $clientID, $serviceID]);

$orderID = $pdo->lastInsertId();

$mysql = "INSERT INTO material(textileID, accessoriesID, orderID) VALUES (?, ?, ?)";
$query = $pdo->prepare($mysql);
$query->execute([NULL, NULL, $orderID]);

$mysql = "INSERT INTO measurements(orderID) VALUES (?)";
$query = $pdo->prepare($mysql);
$query->execute([$orderID]);

$mysql = "INSERT INTO fitting(orderID) VALUES (?)";
$query = $pdo->prepare($mysql);
$query->execute([$orderID]);

header('Location: ../../index.php');
echo '
<script>
alert("Заказ успешно создан!");
</script>
';
exit;
?>