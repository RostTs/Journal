<?php

include '../autoload.php';

$dataBase = new Database;
$db = $dataBase->connect();

$students = new Students($db);

$id = $_GET['id'];
 
$students->delete($id);
