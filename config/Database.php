<?php

class Database 
{
  // Данные для подключения к БД
    private $serverName = 'localhost';
    private $dbName = 'testdb';
    private $userName = 'root';
    private $password = 'root';

    public function connect()
    {
      $conn = mysqli_connect($this->serverName,$this->userName,$this->password,$this->dbName);
      mysqli_set_charset($conn, 'utf8');
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
      return $conn;
    }

}
