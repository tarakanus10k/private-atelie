<?php session_start(); ?>

<!-- Навигационная панель -->
<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
  <div class="container-fluid">
    <!-- Кнопка для раскрытия меню на маленьких экранах -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <!-- Содержимое навигационной панели -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Главная</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pricelist.php">Прайс-лист</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="aboutus.php">О нас</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="atelieinfo.php">Контакты</a>
        </li>
        <?php
        if(!isset($_SESSION['clientID'])) {
          if(!isset($_SESSION['employeeID'])) {
            echo '
            <li class="nav-item">
              <a class="nav-link" href="register.php">Регистрация</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Авторизация</a>
            </li>
            ';
          } else {
            echo '
            <li class="nav-item">
              <a class="nav-link" href="user.php">Личный кабинет</a>
            </li>
            ';
          }
        } else {
          echo '
          <li class="nav-item">
            <a class="nav-link" href="user.php">Личный кабинет</a>
          </li>
          ';
        }
        if(isset($_SESSION['employeeID'])) {
          echo '
          <li class="nav-item">
            <a class="nav-link" href="emp_panel.php">Панель работника</a>
          </li>
          ';
        }
        if(isset($_SESSION['clientID'])) {
          echo '
          <li class="nav-item">
            <a class="nav-link" href="order.php">Сделать заказ</a>
          </li>
          ';
        }
        if(isset($_SESSION['employeeID'])) {
          echo '
          <li class="nav-item">
            <a class="nav-link" href="c_orders.php">Заказы</a>
          </li>
          ';
        }
        if(isset($_SESSION['employeeID'])) {
          echo '
          <li class="nav-item">
            <a class="nav-link" href="materials.php">Материалы</a>
          </li>
          ';
        if(isset($_SESSION['employeeID'])) {
          echo '
          <li class="nav-item">
            <a class="nav-link" href="measurements.php">Замеры</a>
          </li>
          ';
        }
        }
        ?>
      </ul>
    </div>
  </div>
</nav>