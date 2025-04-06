<?php
class User {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Register User
    public function register($data) {
        $this->db->query('INSERT INTO users (name, email, username, password, role) 
                         VALUES (:name, :email, :username, :password, :role)');
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind(':role', 'user');

        // Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Login User
    public function login($username, $password) {
        $this->db->query('SELECT * FROM users WHERE username = :username');
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        if($row) {
            $hashed_password = $row->password;
            if(password_verify($password, $hashed_password)) {
                return $row;
            }
        }
        
        return false;
    }

    // Find user by email
    public function findUserByEmail($email) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        // Bind value
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        // Check row
        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Find user by username
    public function findUserByUsername($username) {
        $this->db->query('SELECT * FROM users WHERE username = :username');
        // Bind value
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        // Check row
        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Get User by ID
    public function getUserById($id) {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        // Bind value
        $this->db->bind(':id', $id);

        return $this->db->single();
    }

    // Get All Users
    public function getUsers() {
        $this->db->query('SELECT * FROM users ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    // Update User
    public function updateUser($data) {
        $passwordSql = !empty($data['password']) ? ', password = :password' : '';
        
        $this->db->query('UPDATE users SET name = :name, email = :email, role = :role' . $passwordSql . ' WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':role', $data['role']);
        
        if(!empty($data['password'])) {
            $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        }

        // Execute
        return $this->db->execute();
    }

    // Delete User
    public function deleteUser($id) {
        $this->db->query('DELETE FROM users WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $id);

        // Execute
        return $this->db->execute();
    }
}
?> 