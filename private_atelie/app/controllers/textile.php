<?php
function addTextile() {
    require '../database/connect.php';

    $textilename = trim(filter_var($_POST['textilename'], FILTER_SANITIZE_SPECIAL_CHARS));
    $textileprice = trim(filter_var($_POST['textileprice'], FILTER_SANITIZE_SPECIAL_CHARS));
    $textilequantity = trim(filter_var($_POST['textilequantity'], FILTER_SANITIZE_SPECIAL_CHARS));

    if(empty($textilename) || empty($textileprice) || empty($textilequantity)) {
        echo 'введите все данные';
        exit;
    }
    $mysql = "INSERT INTO textile(tex_name, tex_pic, tex_unit_price, tex_quantity) VALUES(?, ?, ?, ?)";
    $quary = $pdo->prepare($mysql);
    $quary->execute([$textilename, 'NULL', $textileprice, $textilequantity]);

    echo '
    <script>alert("удачно");</script>
    ';
    Header('Location: ../../textile.php');
}
function deleteTextile() {
    require '../database/connect.php';

    $textileID = trim(filter_var($_POST['tex_ID'], FILTER_SANITIZE_SPECIAL_CHARS));

    if(empty($textileID)) {
        echo 'введите';
        exit;
    }
    $mysql = "DELETE FROM textile WHERE textileID = ?";
    $quary = $pdo->prepare($mysql);
    $quary->execute([$textileID]);

    echo'
    <script>alert("удачно");</script>
    ';
    header('Location: ../../textile.php');
}

if(isset($_POST['action'])) {
    $action = $_POST['action'];

    if($action == 'add') {
        addTextile();
    }
    elseif($action == 'delete') {
        deleteTextile();
    }
    else {
        echo 'ошибка';
        exit;
    }
}
?>