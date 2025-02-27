<?php
function addService() {
    require '../database/connect.php';

    $servicename = trim(filter_var($_POST['service_name'], FILTER_SANITIZE_SPECIAL_CHARS));
    $servicecomm = trim(filter_var($_POST['service_comm'], FILTER_SANITIZE_SPECIAL_CHARS));
    $serviceprice = trim(filter_var($_POST['service_price'], FILTER_SANITIZE_SPECIAL_CHARS));
    $categoriesID = 2;
    if(empty($servicename)) {
        echo 'введите название';
        exit;
    }
    $mysql = "INSERT INTO service(service_name, service_comm, service_price, categoriesID) VALUES(?, ?, ?, ?)";
    $quary = $pdo->prepare($mysql);
    $quary->execute([$servicename, $servicecomm, $serviceprice, $categoriesID]);

    echo '
    <script>alert("удачно");</script>
    ';
    Header('Location: ../../latkishtopka.php');
}
function deleteService() {
    require '../database/connect.php';

    $serviceID = trim(filter_var($_POST['serv_ID'], FILTER_SANITIZE_SPECIAL_CHARS));

    if(empty($serviceID)) {
        echo 'введите';
        exit;
    }
    $mysql = "DELETE FROM service WHERE serviceID = ? AND categoriesID = 2";
    $quary = $pdo->prepare($mysql);
    $quary->execute([$serviceID]);

    echo '
    <script>alert("удачно");</script>
    ';
    Header('Location: ../../latkishtopka.php');
}

if(isset($_POST['action'])) {
    $action = $_POST['action'];
    
    if($action == 'add') {
        addService();
    }
    elseif($action == 'delete') {
        deleteService();
    }
    else {
        echo 'ошибка';
        exit;
    }
}
?>