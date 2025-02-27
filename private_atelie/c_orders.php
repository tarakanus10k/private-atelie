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
    <title>corders</title>
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
      <h2 class="text-center mb-4">Заказы клиентов</h2>
      <p class="text-center">Здесь вы можете просмотреть заказы клиентов</p>
    </div>
  </section>

<!-- Заказы клиентов -->
<?php
require('app/database/connect.php');

$mysql = 'SELECT clients.clientID, clients.first_name AS c_fn, clients.last_name AS c_ln, clients.third_name AS c_tn,
employee.employeeID, employee.first_name AS e_fn, employee.last_name AS e_ln, employee.third_name AS e_tn,
corder.clientID, corder.employeeID, corder.orderID, corder.order_date, fitting.orderID, fitting.fit_results, fitting.plane_date,
categories.categoriesID, categories.categories_name, corder.categoriesID, service.serviceID,
service.service_name, corder.serviceID, corder.order_price
FROM corder
JOIN clients ON corder.clientID = clients.clientID
JOIN employee ON corder.employeeID = employee.employeeID
JOIN fitting ON corder.orderID = fitting.orderID
JOIN categories ON corder.categoriesID = categories.categoriesID
JOIN service ON corder.serviceID = service.serviceID
ORDER BY corder.orderID
';

$query = $pdo->query($mysql);

if($query->rowCount() > 0) {
    echo '
    <div class="container mt-4 category_card">
      <div class="row">
        <table class="table table-borderless table-success table-light">
            <tr>
                <th scope="col">ID заказа</th>
                <th scope="col">ФИО клиента</th>
                <th scope="col">ФИО сотрудника</th>
                <th scope="col">Категория</th>
                <th scope="col">Услуга</th>
                <th scope="col">дата встречи</th>
                <th scope="col">дата примерки</th>
                <th scope="col">результат</th>
                <th scope="col">цена</th>
            </tr>
    ';
    if(isset($_SESSION['employeeID'])) {

      while($row = $query->fetch(PDO::FETCH_ASSOC)) {
        echo '
          <div class="col-md-4 mb-4">
            <div class="position-relative text-center">
              <tr>
                  <th scope="col">' . htmlspecialchars($row['orderID']) . '</th>
                  <th scope="col">' . htmlspecialchars($row['c_ln']) . ' ' . htmlspecialchars(mb_substr($row['c_fn'], 0, 1)) . '.' . htmlspecialchars(mb_substr($row['c_tn'], 0, 1)) . '.' . '</th>
                  <th scope="col">' . htmlspecialchars($row['e_ln'] ?? 'Не назначен') . ' ' . htmlspecialchars(mb_substr($row['e_fn'] ?? '', 0, 1)) . '.' . htmlspecialchars(mb_substr($row['e_tn'] ?? '', 0, 1)) . '.' . '</th>
                  <th scope="col">' . htmlspecialchars($row['categories_name']) . '</th>
                  <th scope="col">' . htmlspecialchars($row['service_name']) . '</th>
                  <th scope="col">' . htmlspecialchars($row['order_date']) . '</th>
                  <th scope="col">' . htmlspecialchars($row['plane_date'] ?? 'не указана') . '</th>
                  <th scope="col">' . htmlspecialchars($row['fit_results']) . '</th>
                  <th scope="col">' . htmlspecialchars($row['order_price'] ?? '0.00') . '</th>
              </tr>
            </div>
          </div>
        ';
      }
    }
    echo '
        </table>';
    echo '</div>
    </div>
    ';
  }
?>
<!-- добавить, удалить, обновить -->
<div class="container mt-4 category_card">
  <div class="row">
   <table class="table table-borderless table-success table-light">
    <tr>
      <th scope="col">ID клиента</th>
      <th scope="col">категория</th>
      <th scope="col">услуга</th>
      <th scope="col">дата встречи</th>
      <th scope="col"></th>
    </tr>
    <div class="col-md-4 mb-4">
      <div class="position-relative text-center">
<!-- добавление -->
        <form class="row justify-content-center" method="post" action="app/controllers/adddeleteupdateorder.php">
          <tr>
            <th scope="col">
              <div class="">
                <label for="clientID" class="form-label">Введите ID</label>
                <input id="clientID" type="text" name="clientID" class="form-control" required>
              </div>
            </th>
            <th scope="col">
            <div class="">
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
            </th>
            <th scope="col">
              <!-- услуга -->
              <div class="">
                <label for="service" class="form-label">Выберите услугу<span class="text-danger"></span></label>
                <select id="service" name="service" class="form-select" required>
                  <option value="" selected disabled>Выберите услугу</option>
                </select>
              </div>
            </th>
            <th scope="col">
              <div class="">
                <label for="odate" class="form-label">Укажите удобную вам дату</label>
                <input id="odate" name="odate" type="date" class="form-control" required>
              </div>
            </th>
            <th scope="col">
              <div class="mb-3 col-12 col-md-4">
              <br>
              <input type="hidden" name="action" value="add">
              <button type="submit" class="btn btn-outline-primary">Добавить</button>
              </div>
            </th>
          </tr>
        </form>
              <!-- удаление -->
        <tr>
          <th scope="col">ID заказа</th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
        <form class="row justify-content-center" method="post" action="app/controllers/adddeleteupdateorder.php">
          <tr>
            <th scope="col">
              <div class="">
                <label for="orderID" class="form-label">Введите номер заказа для удаления</label>
                <input name="orderID" type="text" class="form-control">
              </div>
            </th>
            <th scope="col"></th>
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
        <!-- изменение -->
        <!-- результат примерки, дата примерки, количество тканей, количество фурнитуры, ID ткани, ID фурнитуры, всё что в measurements кроме ID -->
        <tr>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
        <form class="row justify-content-center" method="post" action="app/controllers/adddeleteupdateorder.php">
          <tr>
            <th scope="col">ID заказ</th>
            <th scope="col">
            <div class="">
                <label for="orderID" class="form-label">Укажите ID заказа</label>
                <input id="orderID" name="orderID" type="text" class="form-control" required>
              </div>
            </th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
          <tr>
            <th scope="col">результат примерки</th>
            <th scope="col">
            <div class="">
                <label for="fittingresult" class="form-label">Укажите результат</label>
                <input id="fittingresult" name="fittingresult" type="text" class="form-control">
              </div>
            </th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
          <tr>
            <th scope="col">дата примерки</th>
            <th scope="col">
            <div class="">
                <label for="fittingdate" class="form-label">Укажите дату примерки</label>
                <input id="fittingdate" name="fittingdate" type="date" class="form-control">
              </div>
            </th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
          <tr>
            <th scope="col">ID ткани</th>
            <th scope="col">
            <div class="">
                <label for="textileID" class="form-label">Укажите ID ткани</label>
                <input id="textileID" name="textileID" type="text" class="form-control">
              </div>
            </th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
          <tr>
            <th scope="col">ID фурнитуры</th>
            <th scope="col">
            <div class="">
                <label for="accessoriesID" class="form-label">Укажите ID фурнитуры</label>
                <input id="accessoriesID" name="accessoriesID" type="text" class="form-control">
              </div>
            </th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
          <tr>
            <th scope="col">кол-во ткани</th>
            <th scope="col">
            <div class="">
                <label for="textilequantity" class="form-label">Укажите кол-во ткани</label>
                <input id="textilequantity" name="textilequantity" type="text" class="form-control">
              </div>
            </th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
          <tr>
            <th scope="col">кол-во фурнитуры</th>
            <th scope="col">
            <div class="">
                <label for="accessoriesquantity" class="form-label">Укажите кол-во фурнитуры</label>
                <input id="accessoriesquantity" name="accessoriesquantity" type="text" class="form-control">
              </div>
            </th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
          <tr>
            <th scope="col">ширина плеч</th>
            <th scope="col">
            <div class="">
                <label for="shirinaplech" class="form-label">Укажите замеры</label>
                <input id="shirinaplech" name="shirinaplech" type="text" class="form-control">
              </div>
            </th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
          <tr>
            <th scope="col">полуобхват груди</th>
            <th scope="col">
            <div class="">
                <label for="poluobhvatgrudi" class="form-label">Укажите замеры</label>
                <input id="poluobhvatgrudi" name="poluobhvatgrudi" type="text" class="form-control">
              </div>
            </th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
          <tr>
            <th scope="col">длина рукава</th>
            <th scope="col">
            <div class="">
                <label for="dlinarukava" class="form-label">Укажите замеры</label>
                <input id="dlinarukava" name="dlinarukava" type="text" class="form-control">
              </div>
            </th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
          <tr>
            <th scope="col">длина изделия</th>
            <th scope="col">
            <div class="">
                <label for="dlinaizdeliya" class="form-label">Укажите замеры</label>
                <input id="dlinaizdeliya" name="dlinaizdeliya" type="text" class="form-control">
              </div>
            </th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
          <tr>
            <th scope="col">длина бокового шва</th>
            <th scope="col">
            <div class="">
                <label for="dlinabokovogoshva" class="form-label">Укажите замеры</label>
                <input id="dlinabokovogoshva" name="dlinabokovogoshva" type="text" class="form-control">
              </div>
            </th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
          <tr>
            <th scope="col">полуобхват талии</th>
            <th scope="col">
            <div class="">
                <label for="poluobhvattalii" class="form-label">Укажите замеры</label>
                <input id="poluobhvattalii" name="poluobhvattalii" type="text" class="form-control">
              </div>
            </th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
          <tr>
            <th scope="col">полуобхват бёдер</th>
            <th scope="col">
            <div class="">
                <label for="poluobhvatbeder" class="form-label">Укажите замеры</label>
                <input id="poluobhvatbeder" name="poluobhvatbeder" type="text" class="form-control">
              </div>
            </th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col">
              <div class="mb-3 col-12 col-md-4">
                <br>
                <input type="hidden" name="action" value="update">
                <button type="submit" class="btn btn-outline-primary">изменить</button>
              </div>
            </th>
          </tr>
        </form>
      </div>
    </div>
   </table>
</div>
</div>


<!-- скрипты для оформления заказа -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="assets/js/orderpancheck.js"></script>

<!-- Footer с горизонтальными блоками -->
<?php
include('app/include/footer.php');
?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>