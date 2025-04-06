-- Create database
CREATE DATABASE IF NOT EXISTS blog_db;
USE blog_db;

-- Users table
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Posts table
CREATE TABLE IF NOT EXISTS posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  title VARCHAR(255) NOT NULL,
  slug VARCHAR(255) NOT NULL UNIQUE,
  body TEXT NOT NULL,
  image VARCHAR(255) NOT NULL DEFAULT 'noimage.jpg',
  status ENUM('published', 'draft') NOT NULL DEFAULT 'published',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Create admin user (password: admin123)
INSERT INTO users (name, email, username, password, role) 
VALUES ('Admin User', 'admin@example.com', 'admin', '$2y$10$c9v0Z7GjYaVV9.D1HI86O.ItqfYGM0sbRuGJ3YnmfPL/pWrPFgO/C', 'admin');

-- Create regular user (password: password123)
INSERT INTO users (name, email, username, password, role) 
VALUES ('Test User', 'user@example.com', 'testuser', '$2y$10$fHGMqQdx27uZE1eRrwInHOIUehOkjMiG6FVFVQXn.plFkYRbDpGii', 'user');

-- Sample posts
INSERT INTO posts (user_id, title, slug, body, status) 
VALUES (
  1, 
  'Welcome to Our Blog', 
  'welcome-to-our-blog',
  '<p>This is our first blog post! We''re excited to start sharing content with you.</p><p>In this blog, we''ll be posting about a variety of topics, including technology, web development, and more.</p><p>Stay tuned for more content coming soon!</p>',
  'published'
);

INSERT INTO posts (user_id, title, slug, body, status) 
VALUES (
  2, 
  'Getting Started with PHP MVC', 
  'getting-started-with-php-mvc',
  '<p>The Model-View-Controller (MVC) pattern is a popular design pattern for developing web applications.</p><p>In this post, we''ll explore how to implement the MVC pattern in PHP and why it''s beneficial for organizing your code.</p><h2>What is MVC?</h2><p>MVC stands for:</p><ul><li><strong>Model</strong>: Handles data and business logic</li><li><strong>View</strong>: Renders the user interface</li><li><strong>Controller</strong>: Routes user actions and updates the model or view</li></ul><p>By separating these concerns, your code becomes more organized and maintainable.</p>',
  'published'
);

INSERT INTO posts (user_id, title, slug, body, status) 
VALUES (
  1, 
  'Coming Soon: New Features', 
  'coming-soon-new-features',
  '<p>We''re working on new features for our blog platform!</p><p>Here''s a sneak peek at what''s coming:</p><ul><li>Comment system</li><li>User profiles</li><li>Categories and tags</li><li>Search functionality</li></ul><p>Stay tuned for updates!</p>',
  'draft'
);