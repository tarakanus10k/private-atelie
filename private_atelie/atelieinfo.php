<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>atelieinfo</title>
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
      <h2 class="text-center mb-4">Контакты/График работы</h2>
      <p class="text-center">Свяжись с нами и мы ответим</p>
    </div>
  </section>

    <!-- О нас -->
<div class="py-5">
  <div class="container alter_giper">
    <h4 class="text-center mb-4">График работы</h4>
    <p class="text-center">Пн-Пт: 10:00-20:00</p>
    <h4 class="text-center mb-4">Адрес</h4>
    <p class="text-center">г. Гродно, ул. Лелевеля, д.10</p>
    <h4 class="text-center mb-4">Контакты/Социальные сети/Поддержка</h4>
    <p class="text-center">Телефон: (МТС) +111 (11) 11-111-11</p>
    <p class="text-center">Instagram: <a href="https://www.instagram.com/">instagram.com</a>; Facebook: <a href="https://www.facebook.com/">facebook.com</a></p>
    <p class="text-center">поддержка: <a href="https://mail.google.com/">ateliesupport@email.com</a></p>
  </div>
</div>


<!-- Footer с горизонтальными блоками -->
<?php
include('app/include/footer.php');
?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>