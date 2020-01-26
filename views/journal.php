<?php 
// Проверка, есть ли данные для отображения
 session_start();
 if (isset($_SESSION['result'])) {
  $results = $_SESSION['result'];
} elseif (!isset($_SESSION['noNotes'])) {
  header("Location: ../controllers/Show.php");
}
 include "includes/header.php";


 ?>
<div class="container">
<div class="row mt-5">
 <div class="col-10">
    <h3 class="">Школьный журнал</h3>
 </div>
 <div class="col-2">
 <a class="btn btn-sm btn-primary text-white" href="register.php">Добавить ученика</a>

 </div>
</div>
<table class="table mt-5 ">
  <thead class="thead-light">
    <tr>
      <th scope="col">ФИО</th>
      <th scope="col">День рождения</th>
      <th scope="col">Возраст</th>
      <th scope="col" href="">Редактирование</th>
      <th scope="col">Удаление</th>
    </tr>
  </thead>
  <tbody>
  <?php if (isset($results)) { foreach($results as $result) {?>
    <tr>
      <td><?php echo $result['surname'] . ' ' . $result['firstname'] . ' ' . $result['secondname']; ?></td>
      <td><?php echo $result['birthDate']; ?></td>
      <td><?php echo $result['age']; ?></td>
      <td><a class="btn btn-primary" href=<?php echo "modify.php?surname=$result[surname]&firstname=$result[firstname]&secondname=$result[secondname]&birthDate=$result[birthDate]&id=$result[id]";?>>Редактировать</a></td>
      <td><a class="btn btn-danger" href=<?php echo "../controllers/Delete.php?id=$result[id]";?>>Удалить</a></td>
    </tr>
  <?php }}
   // remove all session variables
session_unset();

// destroy the session
session_destroy();
  ?>

  </tbody>
</table>
</div>
<?php
 include "includes/footer.php";
 