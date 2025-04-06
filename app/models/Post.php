<?php
class Post {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Get All Posts
    public function getPosts($limit = 10, $offset = 0) {
        $this->db->query('SELECT p.*, u.username, u.name 
                          FROM posts p 
                          INNER JOIN users u 
                          ON p.user_id = u.id 
                          WHERE p.status = :status 
                          ORDER BY p.created_at DESC 
                          LIMIT :limit OFFSET :offset');
        $this->db->bind(':status', 'published');
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);

        return $this->db->resultSet();
    }

    // Get Post By ID
    public function getPostById($id) {
        $this->db->query('SELECT p.*, u.username, u.name 
                          FROM posts p 
                          INNER JOIN users u 
                          ON p.user_id = u.id 
                          WHERE p.id = :id');
        $this->db->bind(':id', $id);

        return $this->db->single();
    }

    // Add Post
    public function addPost($data) {
        $this->db->query('INSERT INTO posts (title, slug, body, image, status, user_id) 
                          VALUES (:title, :slug, :body, :image, :status, :user_id)');
        // Bind values
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':slug', $this->createSlug($data['title']));
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':user_id', $data['user_id']);

        // Execute
        if($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    // Update Post
    public function updatePost($data) {
        $this->db->query('UPDATE posts 
                          SET title = :title, slug = :slug, body = :body, 
                              image = :image, status = :status, updated_at = NOW() 
                          WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':slug', $this->createSlug($data['title']));
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':status', $data['status']);

        // Execute
        return $this->db->execute();
    }

    // Delete Post
    public function deletePost($id) {
        $this->db->query('DELETE FROM posts WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $id);

        // Execute
        return $this->db->execute();
    }

    // Get Total Posts Count
    public function getTotalPosts($status = 'published') {
        $this->db->query('SELECT COUNT(*) as total FROM posts WHERE status = :status');
        $this->db->bind(':status', $status);
        $row = $this->db->single();
        return $row->total;
    }

    // Get User Posts
    public function getUserPosts($userId) {
        $this->db->query('SELECT * FROM posts WHERE user_id = :user_id ORDER BY created_at DESC');
        $this->db->bind(':user_id', $userId);

        return $this->db->resultSet();
    }

    // Create URL Slug from title
    private function createSlug($title) {
        // Convert title to lowercase
        $slug = strtolower($title);
        // Replace spaces with hyphens
        $slug = str_replace(' ', '-', $slug);
        // Remove special characters
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
        // Replace multiple hyphens with single hyphen
        $slug = preg_replace('/-+/', '-', $slug);
        // Trim hyphens from beginning and end
        $slug = trim($slug, '-');
        
        return $slug;
    }
}
?> 