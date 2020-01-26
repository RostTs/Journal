<?php

include '../autoload.php';

$dataBase = new Database;
$db = $dataBase->connect();

$students = new Students($db);

$data = array(
    'surname' => $_POST['surname'],
    'name' => $_POST['firstName'],
    'secondName' => $_POST['secondName'],
    'birthDay' => $_POST['birthDay'],
    'id' => $_POST['uid']
);
 
$checker = $students->validate($data, 'modify');

 if ($checker === true) {
    $students->modify($data['id']);
 }
