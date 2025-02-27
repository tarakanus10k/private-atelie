<?php
function addAccessories() {
    require '../database/connect.php';

    $accessoriesname = trim(filter_var($_POST['accname'], FILTER_SANITIZE_SPECIAL_CHARS));
    $accessoriesprice = trim(filter_var($_POST['accprice'], FILTER_SANITIZE_SPECIAL_CHARS));
    $accessoriesquantity = trim(filter_var($_POST['accquantity'], FILTER_SANITIZE_SPECIAL_CHARS));

    if(empty($accessoriesname) || empty($accessoriesprice) || empty($accessoriesquantity)) {
        echo 'введите все данные';
        exit;
    }
    $mysql = "INSERT INTO accessories(acc_name, acc_pic, acc_unit_price, acc_quantity) VALUES(?, ?, ?, ?)";
    $quary = $pdo->prepare($mysql);
    $quary->execute([$accessoriesname, 'NULL', $accessoriesprice, $accessoriesquantity]);

    echo '
    <script>alert("удачно");</script>
    ';
    Header('Location: ../../accessories.php');
}
function deleteAccessories() {
    require '../database/connect.php';

    $accessoriesID = trim(filter_var($_POST['acc_ID'], FILTER_SANITIZE_SPECIAL_CHARS));

    if(empty($accessoriesID)) {
        echo 'введите';
        exit;
    }
    $mysql = "DELETE FROM accessories WHERE accessoriesID = ?";
    $quary = $pdo->prepare($mysql);
    $quary->execute([$accessoriesID]);

    echo'
    <script>alert("удачно");</script>
    ';
    header('Location: ../../accessories.php');
}

if(isset($_POST['action'])) {
    $action = $_POST['action'];

    if($action == 'add') {
        addAccessories();
    }
    elseif($action == 'delete') {
        deleteAccessories();
    }
    else {
        echo 'ошибка';
        exit;
    }
}
?>