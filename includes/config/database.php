<?php

function conectarDB() : mysqli {
    $db = new mysqli('127.0.0.1', 'root', '09870987', 'bienesraices_crud');

    if(!$db) {
        echo "No se conecto";

        exit;
    }
    
    return $db; 
}