<?php 
 include "includes/header.php";
 ?>

 <div class="row justify-content-center">
  <div class="col-3 text-center">
  <?php 
  // Проверка на наличие сообщений об ошибках
    if (isset($_GET['error'])) {
        $error = $_GET['error'];
         switch ($error) {
             case "empty":
                echo '<h3 class="text-danger">Пустые поля!</h3>';
             break;
             case "badChars":
                echo '<h3 class="text-danger">Были использованы недопустимые символы!</h3>';
             break;
             case "dateFotmat":
                echo '<h3 class="text-danger">Неверный формат даты, формат должен быть ДД.MM.ГГГГ!</h3>';
             break;
             default:
             echo '<h3 class="text-danger">Что-то пошло не так!</h3>';
         }
      }
      if (isset($_GET['success'])){ 
        $success = $_GET['success'];
         switch ($success) {
             case "register":
                echo '<h3 class="text-success">Ученик успешно зарегестрирован!</h3>';
             break;
             case "modify":
                echo '<h3 class="text-success">Данные успешно изменены!</h3>';
             break;
             default:
             echo '<h3 class="text-danger">Что-то пошло не так!</h3>';
         }
      }
      ?>
    <form class="form mt-5" method="POST" action="../controllers/Create.php">
        <h2>Добавить ученика</h2>
        <div class="form-group">
            <input type="text" name="surname" placeholder="Фамилия" class="form-control mt-2" required>
            <input type="text" name="firstName" placeholder="Имя" class="form-control mt-2" required>
            <input type="text" name="secondName" placeholder="Отчество" class="form-control mt-2" required>
                <input id="date" type="text" name="birthDay" placeholder="День рождения ДД.MM.ГГГГ" class="form-control mt-2" required
                       pattern="(?:30))|(?:(?:0\[13578\]|1\[02\])-31))/(?:0\[1-9\]|1\[0-9\]|2\[0-9\])|(?:(?!02)(?:0\[1-9\]|1\[0-2\])/(?:19|20)\[0-9\]{2}-(?:(?:0\[1-9\]|1\[0-2\])" title="Введите дату в формате ДД.MM.ГГГГ"/>
            <!-- <input name="birthDay" placeholder="День рождения" class="form-control mt-2 textbox-n" onfocus="(this.type='date')"  id="date" required> -->
            
        </div>
            <input type="submit" class="btn btn-success" value="Сохранить">
            <a type="button" class="btn btn-warning ml-5" href="journal.php">Отменить</a>
    </form>
    </div>
</div>

<?php
 include "includes/footer.php";
