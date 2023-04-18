<?php

require "funciones.php";
require "config/database.php";
require __DIR__ . "/../vendor/autoload.php";

use Model\ActiveRecord;

// Nos conectamos a la base de datos
$db = conectarBD();

ActiveRecord::setDB($db);