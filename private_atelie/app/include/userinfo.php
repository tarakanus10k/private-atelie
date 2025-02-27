<?php session_start(); ?>

<!-- ЛИчный кабинет --> 
<div class="container user_information">
  <div class="d-flex justify-content-center align-items-center">
    <div class="col-12 col-md-4 profile-card mb-3">
      <ul class="list-group">
        <li class="list-group-item"><strong>Имя:</strong><?php echo ' ' . $_SESSION['first_name']; ?></li>
        <li class="list-group-item"><strong>Фамилия:</strong><?php echo ' ' . $_SESSION['last_name']; ?></li>
        <li class="list-group-item"><strong>Очество:</strong><?php echo ' ' . $_SESSION['third_name']; ?></li>
        <li class="list-group-item"><strong>Email:</strong><?php echo ' ' . $_SESSION['email']; ?></li>
        <li class="list-group-item"><strong>Телефон:</strong><?php echo ' ' . $_SESSION['phone_num']; ?></li>
      </ul>
      <?php
      if(!isset($_SESSION['employeeID'])) {
      echo '
        <div class="w-100"></div>
        <a href="order.php">Сделать заказ</a>
      ';
      }
      ?>
    </div>
  </div>
</div>