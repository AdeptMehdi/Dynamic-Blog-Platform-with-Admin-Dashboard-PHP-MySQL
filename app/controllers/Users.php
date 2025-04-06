<?php
class Users extends Controller {
    private $userModel;
    private $postModel;

    public function __construct() {
        $this->userModel = $this->model('User');
        $this->postModel = $this->model('Post');
    }

    // Register new user
    public function register() {
        // Check if user is already logged in
        if($this->isLoggedIn()) {
            $this->redirect('posts');
        }

        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Process form
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'username_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Validate Email
            if(empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else {
                // Check email
                if($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Email is already taken';
                }
            }

            // Validate Name
            if(empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            }

            // Validate Username
            if(empty($data['username'])) {
                $data['username_err'] = 'Please enter username';
            } else {
                // Check username
                if($this->userModel->findUserByUsername($data['username'])) {
                    $data['username_err'] = 'Username is already taken';
                }
            }

            // Validate Password
            if(empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } elseif(strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            // Validate Confirm Password
            if(empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password';
            } else {
                if($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
            }

            // Make sure errors are empty
            if(empty($data['email_err']) && empty($data['name_err']) && empty($data['username_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                // Validated
                
                // Register User
                if($this->userModel->register($data)) {
                    $this->flash('register_success', 'You are registered and can log in');
                    $this->redirect('users/login');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('users/register', $data);
            }

        } else {
            // Init data
            $data = [
                'name' => '',
                'email' => '',
                'username' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'username_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Load view
            $this->view('users/register', $data);
        }
    }

    // User login
    public function login() {
        // Check if user is already logged in
        if($this->isLoggedIn()) {
            $this->redirect('posts');
        }
            
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            // Process form
            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'username_err' => '',
                'password_err' => '',      
            ];

            // Validate Username
            if(empty($data['username'])) {
                $data['username_err'] = 'Please enter username';
            }

            // Validate Password
            if(empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }

            // Check for user/email
            if(!$this->userModel->findUserByUsername($data['username'])) {
                // User not found
                $data['username_err'] = 'No user found';
            }

            // Make sure errors are empty
            if(empty($data['username_err']) && empty($data['password_err'])) {
                // Validated
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data['username'], $data['password']);

                if($loggedInUser) {
                    // Create Session
                    $_SESSION['user_id'] = $loggedInUser->id;
                    $_SESSION['user_email'] = $loggedInUser->email;
                    $_SESSION['user_name'] = $loggedInUser->name;
                    $_SESSION['user_username'] = $loggedInUser->username;
                    $_SESSION['user_role'] = $loggedInUser->role;
                    $this->redirect('posts');
                } else {
                    $data['password_err'] = 'Password incorrect';
                    $this->view('users/login', $data);
                }
            } else {
                // Load view with errors
                $this->view('users/login', $data);
            }
        } else {
            // Init data
            $data = [
                'username' => '',
                'password' => '',
                'username_err' => '',
                'password_err' => '',        
            ];

            // Load view
            $this->view('users/login', $data);
        }
    }

    // Logout User
    public function logout() {
        $_SESSION = [];
        session_destroy();
        $this->redirect('users/login');
    }

    // User profile
    public function profile() {
        if(!$this->isLoggedIn()) {
            $this->redirect('users/login');
        }

        $user = $this->userModel->getUserById($_SESSION['user_id']);
        $posts = $this->postModel->getUserPosts($_SESSION['user_id']);
        
        $data = [
            'user' => $user,
            'posts' => $posts
        ];
        
        $this->view('users/profile', $data);
    }

    // Admin dashboard - users management
    public function dashboard() {
        if(!$this->isLoggedIn() || !$this->isAdmin()) {
            $this->redirect('posts');
        }
        
        $users = $this->userModel->getUsers();
        
        $data = [
            'users' => $users
        ];
        
        $this->view('admin/users/index', $data);
    }

    // Edit user - Admin only
    public function edit($id) {
        if(!$this->isLoggedIn() || !$this->isAdmin()) {
            $this->redirect('posts');
        }
        
        $user = $this->userModel->getUserById($id);
        
        if(!$user) {
            $this->redirect('users/dashboard');
        }
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'role' => trim($_POST['role']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => ''
            ];

            // Validate Name
            if(empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            }

            // Validate Email
            if(empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            }

            // Validate Password (only if provided)
            if(!empty($data['password']) && strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            // Make sure no errors
            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err'])) {
                // Validated
                if($this->userModel->updateUser($data)) {
                    $this->flash('user_message', 'User Updated');
                    $this->redirect('users/dashboard');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('admin/users/edit', $data);
            }
        } else {
            $data = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => ''
            ];

            $this->view('admin/users/edit', $data);
        }
    }

    // Delete User - Admin only
    public function delete($id) {
        if(!$this->isLoggedIn() || !$this->isAdmin()) {
            $this->redirect('posts');
        }
        
        $user = $this->userModel->getUserById($id);
        
        if(!$user) {
            $this->redirect('users/dashboard');
        }
        
        // Don't delete own account
        if($user->id == $_SESSION['user_id']) {
            $this->flash('user_message', 'Cannot delete your own account', 'alert alert-danger');
            $this->redirect('users/dashboard');
        }
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($this->userModel->deleteUser($id)) {
                $this->flash('user_message', 'User Removed');
                $this->redirect('users/dashboard');
            } else {
                die('Something went wrong');
            }
        } else {
            $this->redirect('users/dashboard');
        }
    }
}
?> 