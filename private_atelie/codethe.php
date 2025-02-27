<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>hash</title>
</head>
<body>

<!-- форма регистрации -->
<div class="container reg_form">
<form class="row justify-content-center" method="post" action="app/controllers/codethe.php">
<div class="mb-3 col-12 col-md-4">
  <label for="firstname" class="form-label">имя</label>
  <input name="firstname" type="text" class="form-control" placeholder="Иван" required>
</div>
<div class="w-100"></div>
<div class="mb-3 col-12 col-md-4">
  <label for="lastname" class="form-label">фамилия</label>
  <input name="lastname" type="text" class="form-control" placeholder="Иванчик" required>
</div>
<div class="w-100"></div>
<div class="mb-3 col-12 col-md-4">
  <label for="thirdname" class="form-label">очество</label>
  <input name="thirdname" type="text" class="form-control" placeholder="Иванов" required>
</div>
<div class="w-100"></div>
<div class="mb-3 col-12 col-md-4">
  <label for="phonenumber" class="form-label">номер телефона</label>
  <input name="phonenumber" type="text" class="form-control" placeholder="111111111" required>
</div>
<div class="w-100"></div>
  <div class="mb-3 col-12 col-md-4">
    <label for="email" class="form-label">email</label>
    <input name="email" type="email" class="form-control" aria-describedby="emailHelp" placeholder="ivan@example.com" required>
  </div>
  <div class="w-100"></div>
  <div class="mb-3 col-12 col-md-4">
    <label for="passfirst" class="form-label">пароль</label>
    <input name="passfirst" type="password" class="form-control" required>
  </div>
  <div class="w-100"></div>
  <div class="mb-3 col-12 col-md-4">
    <label for="passsecond" class="form-label">Повторно введите пароль</label>
    <input name="passsecond" type="password" class="form-control" required>
  </div>
  <div class="w-100"></div>
<div class="mb-3 col-12 col-md-4">
<button type="submit" class="btn btn-outline-primary">Добавить</button>
</div>

</form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>