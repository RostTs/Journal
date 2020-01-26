<?php 


class Students
{
    private $conn;
    // Поля из таблицы Students
    public $id;
    public $surname;
    public $firstname;
    public $secondname;
    public $birthdate;
    // Устанавливаем связь с БД
    public function __construct($db){
      $this->conn = $db;
    }
    
    // Проверка данных на валидность перед использованием
    public function validate($data, $place)
    {
      $this->surname = $data['surname'];
      $this->firstname = $data['name'];
      $this->secondname = $data['secondName'];
      $this->birthdate = $data['birthDay'];
      // Проверка на наличие пустых полей
       if (empty($this->surname) || empty($this->firstname) || empty($this->secondname) || empty($this->birthdate)) {
          header("Location: ../views/$place.php?error=empty&surname=$this->surname&firstname=$this->firstname&secondname=$this->secondname&birthDate=$this->birthdate");
          exit();
       }
        // Проверка на наличие пробелов
       else if (preg_match('/\s/',$this->surname) || preg_match('/\s/',$this->firstname) || preg_match('/\s/',$this->secondname || preg_match('/\s/',$this->birthdate))) {
        header("Location: ../views/$place.php?error=empty&surname=$this->surname&firstname=$this->firstname&secondname=$this->secondname&birthDate=$this->birthdate");
        exit();
       }
       // Проверка на наличие символов
       else if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$this->surname) || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$this->firstname) ||
        preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$this->secondname || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$this->birthdate))) {
        header("Location: ../views/$place.php?error=badChars&surname=$this->surname&firstname=$this->firstname&secondname=$this->secondname&birthDate=$this->birthdate");
        exit();
        }
        // Проверка валидность даты
       else if (!preg_match('/[\d{2}\.\d{2}\.\d{4}]/',$this->birthdate)) {
        header("Location: ../views/$place.php?error=dateFotmat&surname=$this->surname&firstname=$this->firstname&secondname=$this->secondname&birthDate=$this->birthdate");
        exit();
       }
       else {
         return true;
       }
    }

    public function create()
    {
     // Высчитывается возраст
      $birthDate = $this->birthdate;
      $birthDate = explode(".", $birthDate);
      $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[0], $birthDate[2]))) > date("md")
        ? ((date("Y") - $birthDate[2]) - 1)
        : (date("Y") - $birthDate[2]));

      $sql = "INSERT INTO students (surname,firstname,secondname,birthdate,age) VALUES (?,?,?,?,?)";
      $stmt = mysqli_stmt_init($this->conn);
      if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("Location: ../views/index.php?error=cannotPrepare&surname=/$this->surname&name=/$this->firstname&secondName=/$this->secondname&birthDate=/$this->birthdate");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt,"ssssi", $this->surname,$this->firstname,$this->secondname,$this->birthdate,$age);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($this->conn);
        header("Location: ../views/index.php?success=register");
        exit();
      }

    }

    public function modify($id)
    {
      // Высчитывается возраст
      $birthDate = $this->birthdate;
      $birthDate = explode(".", $birthDate);
      $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[0], $birthDate[2]))) > date("md")
        ? ((date("Y") - $birthDate[2]) - 1)
        : (date("Y") - $birthDate[2]));

      $sql = "UPDATE students SET surname = ?, firstname = ?, secondname = ?, birthdate = ?, age = ? WHERE id = ?";
      $stmt = mysqli_stmt_init($this->conn);
      if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("Location: ../views/modify.php?error=cannotPrepare&surname=/$this->surname&name=/$this->firstname&secondName=/$this->secondname&birthDate=/$this->birthdate");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt,"ssssii", $this->surname,$this->firstname,$this->secondname,$this->birthdate,$age,$id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($this->conn);
        header("Location: ../views/modify.php?success=modified");
        exit();
      }

    }
    
    public function show()
    {
      $sql = "SELECT * FROM students";
      $results = mysqli_query($this->conn,$sql);
      if (mysqli_num_rows($results) > 0) {
        // Массив со всеми данными
        $allResults = array();
        while($row = mysqli_fetch_assoc($results)) {
          $surname = $row['surname'];
          $firstname = $row['firstname'];
          $secondname = $row['secondname'];
          $birthDate = $row['birthdate'];
          $age = $row['age'];
          $id = $row['id'];
        // Массив с одиночными данными
          $singleResult = [
            'id' => $id,
            'surname' => $surname,
            'firstname' => $firstname,
            'secondname' => $secondname,
            'birthDate' => $birthDate,
            'age' => $age
          ];
          array_push($allResults,$singleResult);
      }
      // Сортировка п алфафиту
      usort($allResults, function($a, $b) {
        return $a['fullName'] <=> $b['fullName'];
    });

      mysqli_close($this->conn);
      // Создается сессия для передачи данных
      session_start();
      $_SESSION['result'] = $allResults;
   
      header("Location: ../views/journal.php");
 
        } else {
          session_start();
          $_SESSION['noNotes'] = 'noNotes';
          header("Location: ../views/journal.php");
      }
    }

    public function delete($id)
    {
     $sql = "DELETE FROM students WHERE id = ?";
     $stmt = mysqli_stmt_init($this->conn);
     if (mysqli_stmt_prepare($stmt,$sql)) {
       mysqli_stmt_bind_param($stmt,"i",$id);
       mysqli_stmt_execute($stmt);
       mysqli_stmt_close($stmt);
       mysqli_close($this->conn);
       header("Location: ../views/journal.php?success=deleted");
       exit();
     }
    }
}
