<?php session_start()?>
<?php
if(!isset($_SESSION['employeeID'])) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>measurements</title>
</head>
<body>

<!-- header с горизонтальными блоками -->
<?php
include('app/include/header.php');
?>
    
<!-- Навигационная панель -->
<?php
include('app/include/nav_pan.php');
?>

<!-- Заголовок -->
<?php
include('app/include/title.php');
?>

  <!-- О нас -->
  <section id="about" class="py-5 bg-white">
    <div class="container">
      <h2 class="text-center mb-4">Замеры клиентов</h2>
      <p class="text-center">Здесь вы можете просмотреть замеры</p>
    </div>
  </section>

<!-- Вывод замеров клиентов -->
<?php
require('app/database/connect.php');

$mysql = 'SELECT * FROM measurements ORDER BY orderID';
$quary = $pdo->query($mysql);
if($quary->rowCount() > 0) {
  echo '
    <div class="container mt-4 category_card">
      <div class="row">
        <table class="table table-borderless table-success table-light">
            <tr>
              <th scope="col">ID заказа</th>
              <th scope="col">ширина плеч</th>
              <th scope="col">полуобхват груди</th>
              <th scope="col">полуобхват талии</th>
              <th scope="col">полуобхват бедер</th>
              <th scope="col">длина рукава</th>
              <th scope="col">длина изделия</th>
              <th scope="col">длина бокового шва</th>
            ';

  while($row = $quary->fetch(PDO::FETCH_ASSOC)) {
    echo '
        <div class="col-md-4 mb-4">
          <div class="position-relative text-center">
            <tr>
              <th scope="col">' . htmlspecialchars($row['orderID']) . '</th>
              <th scope="col">' . htmlspecialchars($row['shirina_plech']) . '</th>
              <th scope="col">' . htmlspecialchars($row['poluobhvat_grudi']) . '</th>
              <th scope="col">' . htmlspecialchars($row['poluobhvat_talii']) . '</th>
              <th scope="col">' . htmlspecialchars($row['poluobhvat_beder']) . '</th>
              <th scope="col">' . htmlspecialchars($row['dlina_rukava']) . '</th>
              <th scope="col">' . htmlspecialchars($row['dlina_izdeliya']) . '</th>
              <th scope="col">' . htmlspecialchars($row['dlina_bokovogo_shva']) . '</th>
            ';
  }

  echo'
            </tr>
          </div>
        </div>
      ';
    echo '
        </table>
      </div>
    </div>
    ';
      
}
?>

<!-- Footer с горизонтальными блоками -->
<?php
include('app/include/footer.php');
?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>