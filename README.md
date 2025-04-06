# MVC Blog System

A dynamic blog system with an admin panel built using PHP, HTML, Tailwind CSS, and JavaScript following the MVC (Model-View-Controller) architecture.

## Features

- User authentication (login, register, logout)
- Admin panel for managing posts and users
- Create, read, update, and delete blog posts
- Responsive design using Tailwind CSS
- Image upload for blog posts
- User roles (admin and regular users)
- Post status (published and draft)

## Technologies Used

- PHP (Plain PHP, no framework)
- MySQL
- HTML
- Tailwind CSS
- JavaScript
- MVC Architecture

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)

## Installation

1. Clone the repository
   ```
   git clone https://github.com/yourusername/blog.git
   ```

2. Set up the database
   - Create a new MySQL database
   - Import the `database.sql` file to set up tables and sample data

3. Configure the database connection
   - Open `app/config/config.php`
   - Update the database credentials:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_USER', 'your_username');
     define('DB_PASS', 'your_password');
     define('DB_NAME', 'blog_db');
     ```

4. Configure the base URL
   - In `app/config/config.php`, update the base URL:
     ```php
     define('BASE_URL', 'http://localhost/blog');
     ```

5. Set up virtual host (optional but recommended)
   - Configure your web server to point to the `public` directory

## Directory Structure

```
blog/
├── app/                  # Application files
│   ├── config/           # Configuration files
│   ├── controllers/      # Controller classes
│   ├── helpers/          # Helper functions
│   ├── models/           # Model classes
│   ├── public/           # Publicly accessible files
│   │   ├── css/          # CSS files
│   │   ├── js/           # JavaScript files
│   │   ├── images/       # Static images
│   │   └── uploads/      # User uploaded files
│   └── views/            # View files
├── public/               # Web root directory
│   ├── index.php         # Entry point
│   └── .htaccess         # URL rewriting rules
└── .htaccess             # Redirect to public directory
```

## Usage

### User Accounts

- Admin account:
  - Username: admin
  - Password: admin123

- Regular user account:
  - Username: testuser
  - Password: password123

### Admin Panel

Access the admin panel at `/admin` after logging in with an admin account. From there, you can:
- View site statistics
- Manage blog posts (create, edit, delete)
- Manage users (view, edit, delete)

### Regular Users

Regular users can:
- Create and manage their own blog posts
- View their profile

## License

This project is open-source and available under the MIT License.

## Credits

Developed by [Your Name] 