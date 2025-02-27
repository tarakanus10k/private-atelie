<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>aboutus</title>
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
      <h2 class="text-center mb-4">О нас</h2>
      <p class="text-center">Узнайте о нашем ателье больше</p>
    </div>
  </section>

    <!-- О нас -->
<div class="py-5">
  <div class="container">
    <h4 class="text-center mb-4">Создаём от нас для вас</h4>
    <p class="text-center">Наше ателье в бизнессе уже 10 и за это время мы преодалели много препядствий</p>
    <p class="text-center">За эти 10 лет было отремантировано и пошито более 1к изделий</p>
    <p class="text-center">К нам обращались одни из самых популярных людей Беларуси(а может даже Европы)</p>
    <p class="text-center">В нашем ателье работают самые лучшие швей</p>
    <p class="text-center">Обращайтесь к нам и ваша жизнь расцветёт по новому</p>
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