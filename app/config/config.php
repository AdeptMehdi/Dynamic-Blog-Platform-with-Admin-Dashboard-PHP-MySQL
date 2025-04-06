<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'blog_db');

// URL Configuration
define('BASE_URL', 'http://localhost/blog/public');

// App Configuration
define('APP_NAME', 'My Blog');
define('APPROOT', dirname(dirname(__FILE__)));
define('DEFAULT_CONTROLLER', 'Posts');
define('DEFAULT_METHOD', 'index');

// Session Configuration
define('SESSION_NAME', 'blog_session');
define('SESSION_LIFETIME', 3600); // 1 hour

// Debug Mode
define('DEBUG_MODE', true);
?> 