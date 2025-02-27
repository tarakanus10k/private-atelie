<?php
require('../database/connect.php');

if(isset($_GET['categoryId'])) {
    $categoryId = intval($_GET['categoryId']);

    $query = "SELECT serviceID, service_name FROM service WHERE categoriesID = :categoryId";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
    $stmt->execute();

    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Возвращаем данные в формате JSON
    header('Content-Type: application/json');
    echo json_encode($services);
    exit;
}
?>