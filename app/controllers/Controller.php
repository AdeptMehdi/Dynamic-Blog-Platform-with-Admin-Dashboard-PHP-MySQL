<?php
/**
 * Base Controller
 * Loads models and views
 */
class Controller {
    // Load model
    public function model($model) {
        // Require model file
        require_once '../app/models/' . $model . '.php';
        // Instantiate model
        return new $model();
    }

    // Load view
    public function view($view, $data = []) {
        // Check for view file
        if(file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            // View does not exist
            die('View does not exist');
        }
    }

    // Redirect to another page
    public function redirect($url) {
        header('location: ' . BASE_URL . '/' . $url);
    }

    // Flash message
    public function flash($name = '', $message = '', $class = 'alert alert-success') {
        if(!empty($name)) {
            if(!empty($message) && empty($_SESSION[$name])) {
                if(!empty($_SESSION[$name])) {
                    unset($_SESSION[$name]);
                }
                if(!empty($_SESSION[$name . '_class'])) {
                    unset($_SESSION[$name . '_class']);
                }
                $_SESSION[$name] = $message;
                $_SESSION[$name . '_class'] = $class;
            } elseif(empty($message) && !empty($_SESSION[$name])) {
                $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
                echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
                unset($_SESSION[$name]);
                unset($_SESSION[$name . '_class']);
            }
        }
    }

    // Check if user is logged in
    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    // Check if user is admin
    public function isAdmin() {
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin';
    }
}
?> 