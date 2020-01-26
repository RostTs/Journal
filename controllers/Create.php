<?php

include '../autoload.php';

$dataBase = new Database;
$db = $dataBase->connect();

$students = new Students($db);

$data = array(
    'surname' => $_POST['surname'],
    'name' => $_POST['firstName'],
    'secondName' => $_POST['secondName'],
    'birthDay' => $_POST['birthDay']
);
 
 $checker = $students->validate($data, 'register');
 
 if ($checker === true) {
    $students->create();
 }
