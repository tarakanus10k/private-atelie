<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>pricelist</title>
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
      <h2 class="text-center mb-4">Категории и услуги</h2>
      <p class="text-center">Здесь вы сможете ознакомиться с категориями и услугами нашего ателье</p>
    </div>
  </section>

<!-- Услуги -->
<?php
require('app/database/connect.php');

$mysql = 'SELECT * FROM categories';
$query = $pdo->query($mysql);

if($query->rowCount() > 0) {
  echo '
  <div class="container mt-4 category_card">
    <div class="row">
  ';
  while($row = $query->fetch(PDO::FETCH_ASSOC)) {
    echo '
      <div class="col-md-4 mb-4">
        <div class="position-relative text-center">
          <img src="' . htmlspecialchars($row['categories_pic']) . '" alt="' . htmlspecialchars($row['categories_name']) . '" class="img-fluid rounded">
          <a href="' . htmlspecialchars($row['link']) . '" class="position-absolute top-50 start-50 translate-middle text-white text-decoration-none fw-bold">' . htmlspecialchars($row['categories_name']) . '</a>
        </div>
      </div>
    ';
  }
  echo '
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