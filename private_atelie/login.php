<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>login</title>
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
      <h2 class="text-center mb-4">Авторизация</h2>
      <p class="text-center">Авторизируйтесь, чтобы получить больше возможностей</p>
    </div>
  </section>

<!-- форма регистрации -->
<div class="container reg_form">
<form class="row justify-content-center" method="post" action="app/controllers/log.php">
<div class="mb-3 col-12 col-md-4">
    <label for="email" class="form-label">Введите email</label>
    <input name="email" type="email" class="form-control" aria-describedby="emailHelp" placeholder="ivan@example.com" required>
    <div id="emailHelp" class="form-text">Мы не передадим ваш email кому-либо еще</div>
  </div>
<div class="w-100"></div>
<div class="mb-3 col-12 col-md-4">
  <label for="phonenumber" class="form-label">Введите номер телефона</label>
  <input name="phonenumber" type="text" class="form-control" placeholder="111111111" required>
</div>
  <div class="w-100"></div>
  <div class="mb-3 col-12 col-md-4">
    <label for="passfirst" class="form-label">Введите пароль</label>
    <input name="passfirst" type="password" class="form-control" required>
  </div>
  <div class="w-100"></div>
<div class="mb-3 col-12 col-md-4">
<button type="submit" class="btn btn-outline-primary">Войти</button>
<a href="register.php">Зарегистрироваться</a>
</div>

</form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Footer с горизонтальными блоками -->
<?php
include('app/include/footer.php');
?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>