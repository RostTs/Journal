<?php

include '../autoload.php';

$dataBase = new Database;
$db = $dataBase->connect();

$students = new Students($db);

$students->show();
