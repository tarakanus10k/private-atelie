<?php session_start(); ?>

<?php
if(!isset($_SESSION['employeeID'])) {
    header('Location, index.php');
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
    <title>panel</title>
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
      <h2 class="text-center mb-4">Панель работника</h2>
      <p class="text-center">Здесь указаны инструкции по использованию сайта работником</p>
    </div>
  </section>

<!-- Панель работника -->
<div class="py-5">
  <div class="container">
    <h4 class="text-center mb-4">Инструкция по использованию инструментов работника</h4>
    <p class="text-center">1. Для создания новой категории обратитесь к разработчику</p>
    <p class="text-center">2. Для измениния, добавления, удаления услуги выберите нужную категорию, там будут кнопки</p>
    <p class="text-center">3. Для изменения, добавления, удаления материалов выберите нужный тип материала, там будут кнопки</p>
    <p class="text-center">4. Для просмотра заказов, в навигационной панели нажмите на "заказы"</p>
    <p class="text-center">5. Функция для изменения заказов ещё не разработана, поэтому обращайтесь к разработчику</p>
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