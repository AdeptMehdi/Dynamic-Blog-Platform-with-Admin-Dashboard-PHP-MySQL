<?php
class Posts extends Controller {
    private $postModel;
    private $userModel;

    public function __construct() {
        // Load Models
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }

    // Display all blog posts
    public function index() {
        // Get page number
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = $page < 1 ? 1 : $page;
        $limit = 5;
        $offset = ($page - 1) * $limit;

        // Get posts
        $posts = $this->postModel->getPosts($limit, $offset);
        
        // Get total posts count
        $totalPosts = $this->postModel->getTotalPosts();
        $totalPages = ceil($totalPosts / $limit);
        
        $data = [
            'posts' => $posts,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ];

        $this->view('posts/index', $data);
    }

    // Show single post
    public function show($id) {
        $post = $this->postModel->getPostById($id);
        
        if(!$post) {
            $this->redirect('posts');
        }
        
        $data = [
            'post' => $post
        ];

        $this->view('posts/show', $data);
    }

    // Add post form
    public function add() {
        // Check if logged in
        if(!$this->isLoggedIn()) {
            $this->redirect('users/login');
        }

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
                'status' => 'published',
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
                    $this->redirect('posts');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('posts/add', $data);
            }
        } else {
            $data = [
                'title' => '',
                'body' => '',
                'title_err' => '',
                'body_err' => ''
            ];

            $this->view('posts/add', $data);
        }
    }

    // Edit post
    public function edit($id) {
        // Check if logged in
        if(!$this->isLoggedIn()) {
            $this->redirect('users/login');
        }

        $post = $this->postModel->getPostById($id);
        
        // Check if post exists
        if(!$post) {
            $this->redirect('posts');
        }
        
        // Check if user is owner or admin
        if($post->user_id != $_SESSION['user_id'] && !$this->isAdmin()) {
            $this->redirect('posts');
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
                'status' => isset($_POST['status']) ? $_POST['status'] : 'published',
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
                    $this->redirect('posts/show/' . $id);
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('posts/edit', $data);
            }
        } else {
            $data = [
                'id' => $id,
                'title' => $post->title,
                'body' => $post->body,
                'image' => $post->image,
                'status' => $post->status,
                'title_err' => '',
                'body_err' => ''
            ];

            $this->view('posts/edit', $data);
        }
    }

    // Delete Post
    public function delete($id) {
        // Check if logged in
        if(!$this->isLoggedIn()) {
            $this->redirect('users/login');
        }

        $post = $this->postModel->getPostById($id);
        
        // Check if post exists
        if(!$post) {
            $this->redirect('posts');
        }
        
        // Check if user is owner or admin
        if($post->user_id != $_SESSION['user_id'] && !$this->isAdmin()) {
            $this->redirect('posts');
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Delete image if not default
            if($post->image != 'noimage.jpg') {
                @unlink('../public/uploads/' . $post->image);
            }
            
            if($this->postModel->deletePost($id)) {
                $this->flash('post_message', 'Post Removed');
                $this->redirect('posts');
            } else {
                die('Something went wrong');
            }
        } else {
            $this->redirect('posts');
        }
    }
}
?> 