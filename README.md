# Modern PHP Blog Application | وبلاگ مدرن با PHP

<div align="center">
  <img src="https://via.placeholder.com/800x400?text=Modern+PHP+Blog" alt="Modern PHP Blog" width="800"/>
  <p>
    <a href="#english-documentation">English</a> | 
    <a href="#persian-documentation">فارسی</a>
  </p>
</div>

---

<div id="english-documentation"></div>

## 🚀 Modern Blog Platform with PHP & Tailwind CSS

A modern, responsive blog application built with PHP MVC architecture and styled with Tailwind CSS. Features include user authentication, post management, admin dashboard, and a beautiful responsive UI with particle animation backgrounds.

### ✨ Features

- **Beautiful Modern UI**
  - Interactive particle background effects
  - Responsive glass-morphism design
  - Animated components and transitions
  - Dark theme with gradient accents

- **Content Management**
  - Create, edit, and delete blog posts
  - Rich text editor with HTML support
  - Image upload for posts
  - User profile management

- **User Experience**
  - User registration and authentication
  - Admin and regular user roles
  - Responsive mobile-first design
  - Intuitive navigation and hamburger menu for mobile

- **Security**
  - Secure password hashing
  - CSRF protection
  - Input validation and sanitization
  - Protected routes based on user roles

### 🔧 Technologies Used

- **Backend**
  - PHP 7.4+
  - MVC Architecture
  - PDO for database interaction
  - Custom router

- **Frontend**
  - Tailwind CSS
  - Vanilla JavaScript
  - Responsive Design
  - SVG Icons

- **Features**
  - Particle.js for background animation
  - Custom text editor
  - File upload handling
  - Session management

### 📋 Installation Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/blog.git
   cd blog
   ```

2. **Configure your web server**
   - Point your web server (Apache, Nginx) to the `public` directory
   - Ensure PHP 7.4+ is installed
   - Enable mod_rewrite for Apache or equivalent for Nginx

3. **Set up the database**
   - Create a MySQL database
   - Import the SQL schema from `app/config/schema.sql` (if available)
   - Update database credentials in `app/config/config.php`

4. **Configure the application**
   - Rename `app/config/config.example.php` to `app/config/config.php`
   - Update the configuration values with your environment settings

5. **Run the application**
   - Visit the application in your browser
   - Register a new user account
   - Enjoy your new blog!

### 🖥️ Usage

**User Registration and Login**
- Navigate to the 'Register' page to create a new account
- Use your credentials to log in
- Access your profile page to update your information

**Creating and Managing Posts**
- Click on the '+New Post' button to create a blog post
- Use the rich text editor to format your content
- Upload images to make your posts visually appealing
- Edit or delete your posts from your profile page

**Admin Features**
- Admin users can access the admin dashboard
- Manage all users and posts
- Moderate content and set user permissions

### 🗂️ Project Structure

```
blog/
├── app/                 # Application core files
│   ├── config/          # Configuration files
│   ├── controllers/     # MVC Controllers
│   ├── helpers/         # Helper functions
│   ├── libraries/       # Core libraries
│   ├── models/          # MVC Models
│   └── views/           # MVC Views and templates
├── public/              # Publicly accessible files
│   ├── css/             # CSS files
│   ├── img/             # Images
│   ├── js/              # JavaScript files
│   └── index.php        # Entry point
└── README.md            # This file
```

### 📄 License

This project is licensed under the MIT License - see the LICENSE file for details.

---

<div id="persian-documentation"></div>

<div dir="rtl">

## 🚀 پلتفرم وبلاگ مدرن با PHP و Tailwind CSS

یک برنامه وبلاگ مدرن و واکنش‌گرا که با معماری MVC در PHP ساخته شده و با Tailwind CSS طراحی شده است. ویژگی‌های آن شامل احراز هویت کاربر، مدیریت پست، داشبورد مدیریت و رابط کاربری زیبا و واکنش‌گرا با پس‌زمینه‌های انیمیشن ذرات است.

### ✨ ویژگی‌ها

- **رابط کاربری مدرن و زیبا**
  - افکت‌های پس‌زمینه ذرات تعاملی
  - طراحی شیشه‌ای واکنش‌گرا (glass-morphism)
  - کامپوننت‌ها و انتقال‌های متحرک
  - تم تاریک با تاکیدهای گرادیانت

- **مدیریت محتوا**
  - ایجاد، ویرایش و حذف پست‌های وبلاگ
  - ویرایشگر متن غنی با پشتیبانی HTML
  - آپلود تصویر برای پست‌ها
  - مدیریت پروفایل کاربر

- **تجربه کاربری**
  - ثبت نام و احراز هویت کاربر
  - نقش‌های مدیر و کاربر عادی
  - طراحی واکنش‌گرا با اولویت موبایل
  - ناوبری شهودی و منوی همبرگر برای موبایل

- **امنیت**
  - هش رمز عبور امن
  - محافظت CSRF
  - اعتبارسنجی و پاکسازی ورودی
  - مسیرهای محافظت شده بر اساس نقش‌های کاربر

### 🔧 فناوری‌های استفاده شده

- **بک‌اند**
  - PHP 7.4+
  - معماری MVC
  - PDO برای تعامل با پایگاه داده
  - روتر سفارشی

- **فرانت‌اند**
  - Tailwind CSS
  - جاوااسکریپت خالص
  - طراحی واکنش‌گرا
  - آیکون‌های SVG

- **ویژگی‌ها**
  - Particle.js برای انیمیشن پس‌زمینه
  - ویرایشگر متن سفارشی
  - مدیریت آپلود فایل
  - مدیریت جلسه

### 📋 دستورالعمل‌های نصب

1. **کلون کردن مخزن**
   ```bash
   git clone https://github.com/yourusername/blog.git
   cd blog
   ```

2. **پیکربندی وب سرور**
   - وب سرور خود (Apache، Nginx) را به دایرکتوری `public` اشاره دهید
   - اطمینان حاصل کنید که PHP 7.4+ نصب شده است
   - mod_rewrite را برای Apache یا معادل آن را برای Nginx فعال کنید

3. **راه‌اندازی پایگاه داده**
   - یک پایگاه داده MySQL ایجاد کنید
   - اسکیمای SQL را از `app/config/schema.sql` وارد کنید (در صورت وجود)
   - اعتبارنامه‌های پایگاه داده را در `app/config/config.php` به‌روزرسانی کنید

4. **پیکربندی برنامه**
   - نام `app/config/config.example.php` را به `app/config/config.php` تغییر دهید
   - مقادیر پیکربندی را با تنظیمات محیط خود به‌روزرسانی کنید

5. **اجرای برنامه**
   - از برنامه در مرورگر خود بازدید کنید
   - یک حساب کاربری جدید ثبت کنید
   - از وبلاگ جدید خود لذت ببرید!

### 🖥️ استفاده

**ثبت نام و ورود کاربر**
- به صفحه 'ثبت نام' بروید تا یک حساب جدید ایجاد کنید
- از اعتبارنامه‌های خود برای ورود استفاده کنید
- به صفحه پروفایل خود دسترسی پیدا کنید تا اطلاعات خود را به‌روزرسانی کنید

**ایجاد و مدیریت پست‌ها**
- برای ایجاد یک پست وبلاگ روی دکمه '+پست جدید' کلیک کنید
- از ویرایشگر متن غنی برای قالب‌بندی محتوای خود استفاده کنید
- تصاویر را آپلود کنید تا پست‌های خود را از نظر بصری جذاب کنید
- پست‌های خود را از صفحه پروفایل خود ویرایش یا حذف کنید

**ویژگی‌های مدیر**
- کاربران مدیر می‌توانند به داشبورد مدیر دسترسی داشته باشند
- همه کاربران و پست‌ها را مدیریت کنند
- محتوا را مدیریت کنند و مجوزهای کاربر را تنظیم کنند

### 🗂️ ساختار پروژه

```
blog/
├── app/                 # فایل‌های اصلی برنامه
│   ├── config/          # فایل‌های پیکربندی
│   ├── controllers/     # کنترلرهای MVC
│   ├── helpers/         # توابع کمکی
│   ├── libraries/       # کتابخانه‌های اصلی
│   ├── models/          # مدل‌های MVC
│   └── views/           # نماها و قالب‌های MVC
├── public/              # فایل‌های قابل دسترسی عمومی
│   ├── css/             # فایل‌های CSS
│   ├── img/             # تصاویر
│   ├── js/              # فایل‌های جاوااسکریپت
│   └── index.php        # نقطه ورود
└── README.md            # این فایل
```

### 📄 مجوز

این پروژه تحت مجوز MIT منتشر شده است - برای جزئیات به فایل LICENSE مراجعه کنید.

</div>

---

<div align="center">
  <p>Made with ❤️ by <a href="https://github.com/adeptmehdi">AdeptMehdi</a></p>
</div> 