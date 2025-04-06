<?php
// Start Session
session_start();

// Load Config
require_once '../app/config/config.php';

// Load Helpers
require_once '../app/helpers/Router.php';
require_once '../app/helpers/functions.php';

// Load Models
require_once '../app/models/Database.php';

// Autoload Core Libraries
spl_autoload_register(function($className) {
    require_once '../app/controllers/' . $className . '.php';
});

// Initialize Router
$router = new Router();
?> 