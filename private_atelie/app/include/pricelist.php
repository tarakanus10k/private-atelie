<?php
require('../database/connect.php');

$mysql = 'SELECT * FROM categories ORDER BY categoriesID';
$query = $pdo->query($mysql);

if($query->rowCount() > 0) {
    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
        echo '
        <div class="row justify-content-center">
            <div class="mb-3 col-4">
                <p>' . htmlspecialchars($row['categories_name']) . '</p>
                <img src="' . htmlspecialchars($row['categories_pic']) . '">
            </div>
        </div>
    ';
    }
}
?>