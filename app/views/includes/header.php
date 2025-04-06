<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($data['title']) ? $data['title'] . ' - ' . APP_NAME : APP_NAME; ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/style.css">
  <script>
    // Responsive tailwind config
    tailwind.config = {
      theme: {
        extend: {
          screens: {
            'xs': '480px',
          },
          zIndex: {
            '60': '60',
            '70': '70',
            '80': '80',
            '90': '90',
            '100': '100',
          }
        }
      }
    }
  </script>
</head>
<body class="min-h-screen flex flex-col bg-gradient-to-br from-gray-900 to-blue-900">
  <!-- Particles Canvas Background -->
  <canvas id="particles-canvas" class="fixed top-0 left-0 w-full h-full"></canvas>
  
  <!-- Overlay for mobile menu -->
  <div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>
  
  <header class="relative z-50 bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg shadow-lg border-b border-white border-opacity-20 sticky top-0">
    <nav class="container mx-auto px-4 py-3 sm:py-4 flex justify-between items-center">
      <a href="<?php echo BASE_URL; ?>" class="text-xl sm:text-2xl font-bold text-white flex items-center">
        <span class="inline-block mr-2 bg-blue-500 text-white p-1.5 sm:p-2 rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
          </svg>
        </span>
        <?php echo APP_NAME; ?>
      </a>
      
      <!-- Desktop Navigation -->
      <div class="hidden md:flex space-x-6 items-center">
        <a href="<?php echo BASE_URL; ?>" class="text-gray-200 hover:text-white transition duration-300 hover:scale-105 transform">Home</a>
        
        <!-- GitHub Link (Desktop) -->
        <a href="https://github.com/adeptmehdi" target="_blank" rel="noopener noreferrer" 
           class="text-gray-200 hover:text-white transition duration-300 hover:scale-105 transform flex items-center">
          <svg class="h-5 w-5 mr-1" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
          </svg>
          GitHub
        </a>
        
        <?php if(isset($_SESSION['user_id'])) : ?>
          <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') : ?>
            <a href="<?php echo BASE_URL; ?>/admin" class="text-gray-200 hover:text-white transition duration-300 hover:scale-105 transform">Admin</a>
          <?php endif; ?>
          <a href="<?php echo BASE_URL; ?>/users/profile" class="text-gray-200 hover:text-white transition duration-300 hover:scale-105 transform">Profile</a>
          <a href="<?php echo BASE_URL; ?>/users/logout" class="ml-2 bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 transform hover:translate-y-[-2px] btn-hover-effect">Logout</a>
        <?php else : ?>
          <a href="<?php echo BASE_URL; ?>/users/login" class="text-gray-200 hover:text-white transition duration-300 hover:scale-105 transform">Login</a>
          <a href="<?php echo BASE_URL; ?>/users/register" class="ml-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 transform hover:translate-y-[-2px] btn-hover-effect">Register</a>
        <?php endif; ?>
      </div>
      
      <!-- Mobile Menu Toggle -->
      <button id="menu-toggle" class="md:hidden text-white focus:outline-none p-1 rounded-lg hover:bg-white/10 transition-all z-60">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </nav>
  </header>
    
  <!-- Mobile Navigation - Side Menu -->
  <div id="mobile-menu" class="fixed top-0 left-0 h-full w-64 md:hidden bg-gray-900 bg-opacity-95 backdrop-filter backdrop-blur-lg shadow-xl z-50 transform -translate-x-full transition-transform duration-300 ease-in-out">
    <div class="flex justify-between items-center p-4 border-b border-gray-800">
      <h3 class="text-xl font-bold text-white">Menu</h3>
      <button id="close-menu" class="text-white p-2 rounded-full hover:bg-gray-800 transition-all">
        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
    <div class="py-6 px-4 space-y-3">
      <a href="<?php echo BASE_URL; ?>" class="block text-gray-200 hover:text-white py-2 px-3 rounded-lg hover:bg-white/10 transition duration-300">
        <div class="flex items-center space-x-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
          </svg>
          <span>Home</span>
        </div>
      </a>
      
      <!-- GitHub Link (Mobile) -->
      <a href="https://github.com/adeptmehdi" target="_blank" rel="noopener noreferrer" 
         class="block text-gray-200 hover:text-white py-2 px-3 rounded-lg hover:bg-white/10 transition duration-300">
        <div class="flex items-center space-x-3">
          <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
          </svg>
          <span>GitHub Profile</span>
        </div>
      </a>
      
      <?php if(isset($_SESSION['user_id'])) : ?>
        <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') : ?>
          <a href="<?php echo BASE_URL; ?>/admin" class="block text-gray-200 hover:text-white py-2 px-3 rounded-lg hover:bg-white/10 transition duration-300">
            <div class="flex items-center space-x-3">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              <span>Admin</span>
            </div>
          </a>
        <?php endif; ?>
        <a href="<?php echo BASE_URL; ?>/users/profile" class="block text-gray-200 hover:text-white py-2 px-3 rounded-lg hover:bg-white/10 transition duration-300">
          <div class="flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span>Profile</span>
          </div>
        </a>
        <a href="<?php echo BASE_URL; ?>/posts/add" class="block text-gray-200 hover:text-white py-2 px-3 rounded-lg hover:bg-white/10 transition duration-300">
          <div class="flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            <span>Create Post</span>
          </div>
        </a>
        <div class="mt-4 px-3">
          <a href="<?php echo BASE_URL; ?>/users/logout" class="block bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 shadow-md w-full text-center">
            <div class="flex items-center justify-center space-x-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
              </svg>
              <span>Logout</span>
            </div>
          </a>
        </div>
      <?php else : ?>
        <a href="<?php echo BASE_URL; ?>/users/login" class="block text-gray-200 hover:text-white py-2 px-3 rounded-lg hover:bg-white/10 transition duration-300">
          <div class="flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
            </svg>
            <span>Login</span>
          </div>
        </a>
        <div class="mt-4 px-3">
          <a href="<?php echo BASE_URL; ?>/users/register" class="block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 shadow-md w-full text-center">
            <div class="flex items-center justify-center space-x-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
              </svg>
              <span>Register</span>
            </div>
          </a>
        </div>
      <?php endif; ?>
    </div>
  </div>
  
  <main class="container mx-auto px-4 py-4 sm:py-6 flex-grow relative z-10"><?php flash('post_message'); ?> 