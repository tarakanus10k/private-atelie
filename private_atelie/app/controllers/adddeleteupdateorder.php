<?php
function addOrder() {
    require('../database/connect.php');

    $clientID = trim(filter_var($_POST['clientID'], FILTER_SANITIZE_SPECIAL_CHARS));
    $categoryID = trim(filter_var($_POST['category'], FILTER_SANITIZE_SPECIAL_CHARS));
    $serviceID = trim(filter_var($_POST['service'], FILTER_SANITIZE_SPECIAL_CHARS));
    $dateID = trim(filter_var($_POST['odate'], FILTER_SANITIZE_SPECIAL_CHARS));

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

    header('Location: ../../c_orders.php');
    echo '
    <script>
    alert("Заказ успешно создан!");
    </script>
    ';
    exit;
}
function deleteOrder() {
    require('../database/connect.php');

    $orderID = trim(filter_var($_POST['orderID'], FILTER_SANITIZE_SPECIAL_CHARS));

    if(empty($orderID)) {
        echo 'введите ID';
        exit;
    }
    $mysql = "DELETE FROM fitting WHERE orderID = ?";
    $quary = $pdo->prepare($mysql);
    $quary->execute([$orderID]);

    $mysql = "DELETE FROM material WHERE orderID = ?";
    $quary = $pdo->prepare($mysql);
    $quary->execute([$orderID]);

    $mysql = "DELETE FROM measurements WHERE orderID = ?";
    $quary = $pdo->prepare($mysql);
    $quary->execute([$orderID]);

    $mysql = "DELETE FROM corder WHERE orderID = ?";
    $quary = $pdo->prepare($mysql);
    $quary->execute([$orderID]);

    echo '
    <script>alert("удачно");</script>
    ';
    Header('Location: ../../c_orders.php');
}
function updateOrder() {
    require('../database/connect.php');

    $orderID = trim(filter_var($_POST['orderID'], FILTER_SANITIZE_SPECIAL_CHARS));

    if(empty($orderID)) {
        echo 'введите ID';
        exit;
    }

    $mysql = 'SELECT * FROM fitting
    JOIN material ON fitting.orderID = material.orderID
    JOIN measurements ON fitting.orderID = measurements.orderID
    WHERE fitting.orderID = ?
    ';
    $quary = $pdo->prepare($mysql);
    $quary->execute([$orderID]);

    $curData = $quary->fetch(PDO::FETCH_ASSOC);

    $fittingresult = !empty($_POST['fittingresult']) ? trim(filter_var($_POST['fittingresult'], FILTER_SANITIZE_SPECIAL_CHARS)) : $curData['fit_results'];
    $fittingdate = !empty($_POST["fittingdate"]) ? trim(filter_var($_POST['fittingdate'], FILTER_SANITIZE_SPECIAL_CHARS)) : $curData['plane_date'];
    $textileID = !empty($_POST['textileID']) ? trim(filter_var($_POST['textileID'], FILTER_SANITIZE_SPECIAL_CHARS)) : $curData['textileID'];
    $accessoriesID = !empty($_POST['accessoriesID']) ? trim(filter_var($_POST['accessoriesID'], FILTER_SANITIZE_SPECIAL_CHARS)) : $curData['accessoriesID'];
    $textilequantity = !empty($_POST['textilequantity']) ? trim(filter_var($_POST['textilequantity'], FILTER_SANITIZE_SPECIAL_CHARS)) : $curData['tex_q'];
    $accessoriesquantity = !empty($_POST['accessoriesquantity']) ? trim(filter_var($_POST['accessoriesquantity'], FILTER_SANITIZE_SPECIAL_CHARS)) : $curData['acc_q'];
    $shirinaplech = !empty($_POST['shirinaplech']) ? trim(filter_var($_POST['shirinaplech'], FILTER_SANITIZE_SPECIAL_CHARS)) : $curData['shirina_plech'];
    $poluobhvatgrudi = !empty($_POST['poluobhvatgrudi']) ? trim(filter_var($_POST['poluobhvatgrudi'], FILTER_SANITIZE_SPECIAL_CHARS)) : $curData['poluobhvat_grudi'];
    $dlinarukava = !empty($_POST['dlinarukava']) ? trim(filter_var($_POST['dlinarukava'], FILTER_SANITIZE_SPECIAL_CHARS)) : $curData['dlina_rukava'];
    $dlinaizdeliya = !empty($_POST['dlinaizdeliya']) ? trim(filter_var($_POST['dlinaizdeliya'], FILTER_SANITIZE_SPECIAL_CHARS)) : $curData['dlina_izdeliya'];
    $dlinabokovogoshva = !empty($_POST['dlinabokovogoshva']) ? trim(filter_var($_POST['dlinabokovogoshva'], FILTER_SANITIZE_SPECIAL_CHARS)) : $curData['dlina_bokovogo_shva'];
    $poluobhvattalii = !empty($_POST['poluobhvattalii']) ? trim(filter_var($_POST['poluobhvattalii'], FILTER_SANITIZE_SPECIAL_CHARS)) : $curData['poluobhvat_talii'];
    $poluobhvatbeder = !empty($_POST['poluobhvatbeder']) ? trim(filter_var($_POST['poluobhvatbeder'], FILTER_SANITIZE_SPECIAL_CHARS)) : $curData['poluobhvat_beder'];



    $mysql = "UPDATE fitting SET fit_results = ?, plane_date = ? WHERE orderID = ?";
    $quary = $pdo->prepare($mysql);
    $quary->execute([$fittingresult, $fittingdate, $orderID]);

    $mysql = "UPDATE material SET textileID = ?, accessoriesID = ?, tex_q = ?, acc_q = ? WHERE orderID = ?";
    $quary = $pdo->prepare($mysql);
    $quary->execute([$textileID, $accessoriesID, $textilequantity, $accessoriesquantity, $orderID]);

    $mysql = "UPDATE measurements SET shirina_plech = ?, poluobhvat_grudi = ?, dlina_rukava = ?, dlina_izdeliya = ?, dlina_bokovogo_shva = ?, poluobhvat_talii = ?, poluobhvat_beder = ? WHERE orderID = ?";
    $quary = $pdo->prepare($mysql);
    $quary->execute([$shirinaplech, $poluobhvatgrudi, $dlinarukava, $dlinaizdeliya, $dlinabokovogoshva, $poluobhvattalii, $poluobhvatbeder, $orderID]);

    echo'
    <script>alert("удачно");</script>
    ';
    header('Location: ../../c_orders.php');
}
if(isset($_POST['action'])) {
    $action = $_POST['action'];

    if($action == 'add') {
        addOrder();
    }
    elseif($action == 'delete') {
        deleteOrder();
    }
    elseif($action == 'update') {
        updateOrder();
    }
    else {
        echo 'ошибка';
        exit;
    }
}
?>