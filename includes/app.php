<?php 

require 'funciones.php'; 
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

use App\Propiedad;

// Conectar a la DB
$db = conectarDB();

Propiedad::setDB($db);
