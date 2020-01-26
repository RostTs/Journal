<?php

 spl_autoload_register( function($className) {

    $fileName = '../models/' . $className.'.php';
    
     if (file_exists($fileName)) {
        include $fileName;
     } else {
        $fileName = '../config/' . $className.'.php';
        if (file_exists($fileName)) {
            include $fileName;
        } else {
            return false;
        }
     }
 }

);
