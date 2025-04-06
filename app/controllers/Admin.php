<?php
class Admin extends Controller {
    private $postModel;
    private $userModel;

    public function __construct() {
        // Check if user is admin
        if(isset($_SESSION['user_id']) && isset($_SESSION['user_role'])) {
            if($_SESSION['user_role'] != 'admin') {
                header('location: ' . BASE_URL);
                exit;
            }
        } else {
            header('location: ' . BASE_URL . '/users/login');
            exit;
        }

        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }

    // Admin Dashboard
    public function index() {
        // Get stats
        $totalPosts = $this->postModel->getTotalPosts();
        $totalPostsDraft = $this->postModel->getTotalPosts('draft');
        $totalUsers = count($this->userModel->getUsers());
        
        $data = [
            'totalPosts' => $totalPosts,
            'totalPostsDraft' => $totalPostsDraft,
            'totalUsers' => $totalUsers
        ];

        $this->view('admin/index', $data);
    }

    // Posts Management
    public function posts() {
        // Get all posts including drafts for admin
        $this->db = new Database;
        $this->db->query('SELECT p.*, u.username, u.name 
                        FROM posts p 
                        INNER JOIN users u 
                        ON p.user_id = u.id 
                        ORDER BY p.created_at DESC');
        $posts = $this->db->resultSet();
        
        $data = [
            'posts' => $posts
        ];

        $this->view('admin/posts/index', $data);
    }

    // Create Post from Admin
    public function addPost() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            // Handle file upload
            $imageFileName = 'noimage.jpg';
            if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $upload_dir = APPROOT . '/public/uploads/';
                $imageFileName = time() . '_' . $_FILES['image']['name'];
                $target_file = $upload_dir . $imageFileName;
                
                // Check if image file is a actual image
                $check = getimagesize($_FILES['image']['tmp_name']);
                if($check !== false) {
                    // Upload file
                    if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                        $imageFileName = $imageFileName;
                    } else {
                        $imageFileName = 'noimage.jpg';
                    }
                } else {
                    $imageFileName = 'noimage.jpg';
                }
            }

            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'image' => $imageFileName,
                'status' => trim($_POST['status']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];

            // Validate title
            if(empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }

            // Validate body
            if(empty($data['body'])) {
                $data['body_err'] = 'Please enter content';
            }

            // Make sure no errors
            if(empty($data['title_err']) && empty($data['body_err'])) {
                // Validated
                if($this->postModel->addPost($data)) {
                    $this->flash('post_message', 'Post Added');
                    $this->redirect('admin/posts');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('admin/posts/add', $data);
            }
        } else {
            $data = [
                'title' => '',
                'body' => '',
                'status' => 'published',
                'title_err' => '',
                'body_err' => ''
            ];

            $this->view('admin/posts/add', $data);
        }
    }

    // Edit Post from Admin
    public function editPost($id) {
        $post = $this->postModel->getPostById($id);
        
        if(!$post) {
            $this->redirect('admin/posts');
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            // Handle file upload
            $imageFileName = $post->image;
            if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $upload_dir = APPROOT . '/public/uploads/';
                $imageFileName = time() . '_' . $_FILES['image']['name'];
                $target_file = $upload_dir . $imageFileName;
                
                // Check if image file is a actual image
                $check = getimagesize($_FILES['image']['tmp_name']);
                if($check !== false) {
                    // Upload file
                    if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                        // Delete old image if not default
                        if($post->image != 'noimage.jpg') {
                            @unlink($upload_dir . $post->image);
                        }
                        $imageFileName = $imageFileName;
                    }
                }
            }

            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'image' => $imageFileName,
                'status' => trim($_POST['status']),
                'title_err' => '',
                'body_err' => ''
            ];

            // Validate title
            if(empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }

            // Validate body
            if(empty($data['body'])) {
                $data['body_err'] = 'Please enter content';
            }

            // Make sure no errors
            if(empty($data['title_err']) && empty($data['body_err'])) {
                // Validated
                if($this->postModel->updatePost($data)) {
                    $this->flash('post_message', 'Post Updated');
                    $this->redirect('admin/posts');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('admin/posts/edit', $data);
            }
        } else {
            $data = [
                'id' => $post->id,
                'title' => $post->title,
                'body' => $post->body,
                'image' => $post->image,
                'status' => $post->status,
                'title_err' => '',
                'body_err' => ''
            ];

            $this->view('admin/posts/edit', $data);
        }
    }

    // Delete Post from Admin
    public function deletePost($id) {
        $post = $this->postModel->getPostById($id);
        
        if(!$post) {
            $this->redirect('admin/posts');
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Delete image if not default
            if($post->image != 'noimage.jpg') {
                @unlink(APPROOT . '/public/uploads/' . $post->image);
            }
            
            if($this->postModel->deletePost($id)) {
                $this->flash('post_message', 'Post Removed');
                $this->redirect('admin/posts');
            } else {
                die('Something went wrong');
            }
        } else {
            $this->redirect('admin/posts');
        }
    }
}
?> 