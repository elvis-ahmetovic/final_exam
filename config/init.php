<?php
session_start();

require_once('config.php');
require_once('helpers/helper.php');

//Autoloader
spl_autoload_register(function($class) {
    include 'classes/' . $class . '.class.php';
});

?>