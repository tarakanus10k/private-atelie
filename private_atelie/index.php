<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>index</title>
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
    <div class="container alter_giper">
      <a href="aboutus.php"><h2 class="text-center mb-4">О нас</h2></a>
      <p class="text-center">Наше ателье специализируется на индивидуальном пошиве одежды, ремонте и подгонке ваших любимых вещей. Мы гарантируем высокое качество работы и внимание к деталям.</p>
    </div>
  </section>

    <!-- Услуги -->
    <section id="services" class="py-5 bg-light">
    <div class="container alter_giper">
      <a href="pricelist.php"><h2 class="text-center mb-4">Наши услуги</h2></a>
      <div class="row">
        <div class="col-md-4 text-center">
          <div class="card p-3">
            <a href="pricelist.php">
            <h4>Индивидуальный пошив</h4>
            <p>Создание уникальных изделий по вашим меркам.</p>
            </a>
          </div>
        </div>
        <div class="col-md-4 text-center">
          <div class="card p-3">
            <a href="pricelist.php">
            <h4>Ремонт одежды</h4>
            <p>Починка одежды любой сложности.</p>
            </a>
          </div>
        </div>
        <div class="col-md-4 text-center">
          <div class="card p-3">
            <a href="pricelist.php">
            <h4>Подгонка одежды</h4>
            <p>Идеальная посадка ваших вещей по фигуре.</p>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>


<!-- Footer с горизонтальными блоками -->
<?php
include('app/include/footer.php');
?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>