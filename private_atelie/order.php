<?php session_start(); ?>

<?php
if(!isset($_SESSION['clientID'])) {
  if(!isset($_SESSION['employeeID'])) {
    header('Location: index.php');
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>order</title>
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
      <h2 class="text-center mb-4">Сделать заказ</h2>
      <p class="text-center">Здесь вы сможете сделать заказ</p>
    </div>
  </section>

<!-- Панель для заказа -->
<div class="container mt-5">
  <form class="row justify-content-center" action="app/controllers/procc_order.php" method="post">
    <!-- категория -->
    <div class="mb-3 col-12 col-md-4">
      <label for="category" class="form-label">Выберите категорию<span class="text-danger"></span></label>
        <select id="category" name="category" class="form-select" required>
          <option value="" selected disabled>Выберите категорию</option>
          <?php
          require('app/database/connect.php');

          $categoriesQ = "SELECT categoriesID, categories_name FROM categories";
          $categoriesR = $pdo->query($categoriesQ);
          while($category = $categoriesR->fetch(PDO::FETCH_ASSOC)) {
            echo '
            <option value="' . htmlspecialchars($category['categoriesID']) . '">' . htmlspecialchars($category['categories_name']) . '</option>
            ';
          }
          ?>
        </select>
    </div>
    <div class="w-100"></div>
    <!-- услуга -->
    <div class="mb-3 col-12 col-md-4">
      <label for="service" class="form-label">Выберите услугу<span class="text-danger"></span></label>
        <select id="service" name="service" class="form-select" required>
          <option value="" selected disabled>Выберите услугу</option>
        </select>
    </div>
    <div class="w-100"></div>
    <!-- дата -->
    <div class="mb-3 col-12 col-md-4">
      <label for="odate" class="form-label">Укажите удобную вам дату</label>
        <input id="odate" name="odate" type="date" class="form-control" required>
    </div>
    <div class="w-100"></div>
    <!-- кнопка отправки -->
    <div class="mb-3 col-12 col-md-4">
      <button type="submit" class="btn btn-outline-primary" id="submitBtn">Оформить заказ</button>
    </div>
  </form>
</div>

<!-- скрипты для оформления заказа -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="assets/js/ordercheck.js"></script>

<!-- Footer с горизонтальными блоками -->
<?php
include('app/include/footer.php');
?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>