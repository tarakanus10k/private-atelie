<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>poshivodejdi</title>
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
      <h2 class="text-center mb-4">Пошив одежды</h2>
      <p class="text-center">Ознакомтесь с услугами из категории "Пошив одежды"</p>
    </div>
  </section>

<!-- Вывод прайс-листа -->
<?php
require('app/database/connect.php');
$mysql = 'SELECT * FROM service WHERE categoriesID = 7';
$query = $pdo->query($mysql);

if($query->rowCount() > 0) {
  echo '
  <div class="container mt-4 category_card">
    <div class="row">
      <table class="table table-borderless table-success table-light">
          <tr>';

            if(isset($_SESSION['employeeID'])) {
              echo'
              <th scope="col">ID</th>
              <th scope="col">название</th>
              <th scope="col">разновидность</th>
              <th scope="col">цена</th>
              ';
            }
            else {
              echo'
              <th scope="col">название</th>
              <th scope="col">разновидность</th>
              <th scope="col">цена</th>
              ';
            }

  echo'
          </tr>
  ';
  while($row = $query->fetch(PDO::FETCH_ASSOC)) {
    echo '
      <div class="col-md-4 mb-4">
        <div class="position-relative text-center">
          <tr>';
          
          if(isset($_SESSION['employeeID'])) {
            echo'
            <th scope="col">' . htmlspecialchars($row['serviceID']) . '</th>
            <th scope="col">' . htmlspecialchars($row['service_name']) . '</th>
            <th scope="col">' . htmlspecialchars($row['service_comm']) . '</th>
            <th scope="col">' . htmlspecialchars($row['service_price']) . '</th>
            ';
          }
          else {
            echo'
            <th scope="col">' . htmlspecialchars($row['service_name']) . '</th>
            <th scope="col">' . htmlspecialchars($row['service_comm']) . '</th>
            <th scope="col">' . htmlspecialchars($row['service_price']) . '</th>
            ';
          }
          
    echo'
          </tr>
        </div>
      </div>
    ';
  }
  echo '
      </table>
    </div>
  </div>
  ';
}
?>


<!-- добавить -->
<?php if(isset($_SESSION['employeeID'])): ?>
<div class="container mt-4 category_card">
  <div class="row">
   <table class="table table-borderless table-success table-light">
    <tr>
      <th scope="col">название</th>
      <th scope="col">разновидность</th>
      <th scope="col">цена</th>
      <th scope="col"></th>
    </tr>
    <div class="col-md-4 mb-4">
      <div class="position-relative text-center">
        <form class="row justify-content-center" method="post" action="app/controllers/poshivodejdi.php">
          <tr>
            <th scope="col">
              <div class="">
              <label for="service_name" class="form-label">Введите имя услуги</label>
              <input name="service_name" type="text" class="form-control" required>
            </th>
            <th scope="col">
              <div class="">
              <label for="service_comm" class="form-label">Введите вариации услуги</label>
              <input name="service_comm" type="text" class="form-control" required>
            </th>
            <th scope="col">
              <div class="">
              <label for="service_price" class="form-label">Введите цену</label>
              <input name="service_price" type="text" class="form-control" required>
            </th>
            <th scope="col">
              <div class="mb-3 col-12 col-md-4">
              <br>
              <button type="submit" class="btn btn-outline-primary">Добавить</button>
            </th>
          </tr>
        </form>
        <form class="row justify-content-center" method="post" action="app/controllers/latkishtopka.php">
          <tr>
            <th scope="col">
              <div class="">
                <label for="serv_ID" class="form-label">Введите номер услуги для удаления</label>
                <input name="serv_ID" type="text" class="form-control" required>
              </div>
            </th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col">
              <div class="mb-3 col-12 col-md-4">
                <br>
                <input type="hidden" name="action" value="delete">
                <button type="submit" class="btn btn-outline-primary">Удалить</button>
              </div>
            </th>
          </tr>
        </form>
      </div>
    </div>
   </table>
  </div>
</div>
<?php endif; ?>
<!--  -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Footer с горизонтальными блоками -->
<?php
include('app/include/footer.php');
?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>