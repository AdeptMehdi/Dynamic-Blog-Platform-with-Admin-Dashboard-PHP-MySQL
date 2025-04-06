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
          },
          animation: {
            'float': 'float 3s ease-in-out infinite',
            'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
            'bounce-slow': 'bounce 3s infinite',
            'gradient': 'gradient 8s ease infinite',
          },
          keyframes: {
            float: {
              '0%, 100%': { transform: 'translateY(0)' },
              '50%': { transform: 'translateY(-10px)' },
            },
            gradient: {
              '0%': { backgroundPosition: '0% 50%' },
              '50%': { backgroundPosition: '100% 50%' },
              '100%': { backgroundPosition: '0% 50%' },
            }
          }
        }
      }
    }
  </script>
</head>
<body class="min-h-screen flex flex-col bg-gradient-to-br from-gray-900 to-blue-900">
  <!-- Particles Canvas Background -->
  <canvas id="particles-canvas" class="fixed top-0 left-0 w-full h-full"></canvas>
  
  <!-- Animated Header -->
  <header class="relative z-40 sticky top-0 transition-all duration-500 ease-in-out" id="animated-header">
    <!-- Gradient animated border -->
    <div class="absolute bottom-0 left-0 right-0 h-[2px] bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 animate-gradient bg-[length:200%_200%]"></div>
    
    <!-- Main header content -->
    <div class="backdrop-filter backdrop-blur-lg bg-black/20 shadow-2xl">
      <div class="container mx-auto px-4 relative">
        <!-- Top bar with logo and nav -->
        <nav class="flex items-center justify-between h-16 sm:h-20">
          <!-- Logo with animation -->
          <a href="<?php echo BASE_URL; ?>" class="group flex items-center space-x-2 sm:space-x-3">
            <div class="relative w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center overflow-hidden rounded-lg bg-gradient-to-br from-blue-600 to-indigo-800 shadow-lg transform transition duration-500 group-hover:scale-110 group-hover:rotate-3">
              <span class="absolute w-full h-full bg-white opacity-10 transform rotate-45 translate-x-3 -translate-y-3 group-hover:translate-x-4 group-hover:-translate-y-4 transition duration-700"></span>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-7 sm:w-7 text-white relative z-10 animate-float" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
              </svg>
            </div>
            <span class="text-xl sm:text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-white to-blue-200"><?php echo APP_NAME; ?></span>
          </a>
          
          <!-- Desktop Navigation with animations -->
          <div class="hidden md:flex items-center space-x-1 lg:space-x-3">
            <a href="<?php echo BASE_URL; ?>" class="relative px-4 py-2 text-gray-200 hover:text-white group">
              <span class="relative z-10">Home</span>
              <span class="absolute inset-0 h-full w-full bg-white/10 scale-0 group-hover:scale-100 rounded-full transition-transform duration-300 ease-out origin-bottom"></span>
            </a>
            
            <!-- GitHub Link (Desktop) -->
            <a href="https://github.com/adeptmehdi" target="_blank" rel="noopener noreferrer" class="relative px-4 py-2 text-gray-200 hover:text-white group">
              <span class="relative z-10 flex items-center">
                <svg class="h-5 w-5 mr-1" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                </svg>
                GitHub
              </span>
              <span class="absolute inset-0 h-full w-full bg-white/10 scale-0 group-hover:scale-100 rounded-full transition-transform duration-300 ease-out origin-bottom"></span>
            </a>
            
            <!-- User navigation with animations -->
            <?php if(isset($_SESSION['user_id'])) : ?>
              <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') : ?>
                <a href="<?php echo BASE_URL; ?>/admin" class="relative px-4 py-2 text-gray-200 hover:text-white group">
                  <span class="relative z-10">Admin</span>
                  <span class="absolute inset-0 h-full w-full bg-white/10 scale-0 group-hover:scale-100 rounded-full transition-transform duration-300 ease-out origin-bottom"></span>
                </a>
              <?php endif; ?>
              
              <a href="<?php echo BASE_URL; ?>/users/profile" class="relative px-4 py-2 text-gray-200 hover:text-white group">
                <span class="relative z-10">Profile</span>
                <span class="absolute inset-0 h-full w-full bg-white/10 scale-0 group-hover:scale-100 rounded-full transition-transform duration-300 ease-out origin-bottom"></span>
              </a>
              
              <!-- Enhanced New Post Button -->
              <a href="<?php echo BASE_URL; ?>/posts/add" class="relative overflow-hidden px-5 py-2.5 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-lg shadow-md hover:scale-105 hover:shadow-lg transition-all duration-300 ease-out group">
                <span class="relative z-10 flex items-center font-medium">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                  </svg>
                  New Post
                </span>
                <span class="absolute top-0 left-0 w-full h-full bg-white opacity-0 group-hover:opacity-20 transition-opacity duration-300"></span>
                <span class="absolute top-0 left-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-in-out"></span>
              </a>
              
              <a href="<?php echo BASE_URL; ?>/users/logout" class="relative overflow-hidden px-5 py-2.5 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg shadow-md hover:scale-105 transition-all duration-300 ease-out">
                <span class="relative z-10">Logout</span>
                <span class="absolute top-0 left-0 w-full h-full bg-white opacity-0 hover:opacity-20 transition-opacity duration-300"></span>
              </a>
            <?php else : ?>
              <a href="<?php echo BASE_URL; ?>/users/login" class="relative px-4 py-2 text-gray-200 hover:text-white group">
                <span class="relative z-10">Login</span>
                <span class="absolute inset-0 h-full w-full bg-white/10 scale-0 group-hover:scale-100 rounded-full transition-transform duration-300 ease-out origin-bottom"></span>
              </a>
              
              <a href="<?php echo BASE_URL; ?>/users/register" class="relative overflow-hidden px-5 py-2.5 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-lg shadow-md hover:scale-105 transition-all duration-300 ease-out">
                <span class="relative z-10">Register</span>
                <span class="absolute top-0 left-0 w-full h-full bg-white opacity-0 hover:opacity-20 transition-opacity duration-300"></span>
              </a>
            <?php endif; ?>
          </div>
          
          <!-- NEW Simple Hamburger Menu Button -->
          <button id="hamburger-menu" class="md:hidden w-10 h-10 flex flex-col justify-center items-center focus:outline-none">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
          </button>
        </nav>
      </div>
    </div>
  </header>
  
  <!-- NEW Mobile Menu Overlay -->
  <div id="mobile-menu-overlay" class="fixed inset-0 bg-black bg-opacity-70 z-50 hidden"></div>
  
  <!-- NEW Mobile Menu - Side Drawer -->
  <div id="mobile-menu-drawer" class="fixed top-0 left-0 w-64 h-full bg-gray-900 z-50 shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out">
    <div class="flex flex-col h-full overflow-y-auto">
      <!-- Menu Header with Close Button -->
      <div class="flex items-center justify-between p-4 border-b border-gray-800">
        <div class="text-xl font-bold text-white">Menu</div>
        <button id="mobile-menu-close" class="p-1 rounded-full hover:bg-gray-800">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
      
      <!-- Menu Content -->
      <div class="p-4 space-y-4">
        <a href="<?php echo BASE_URL; ?>" class="mobile-menu-item flex items-center gap-3 text-white hover:bg-blue-900/30 p-3 rounded-lg transition-all">
          <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
          </svg>
          <span>Home</span>
        </a>
        
        <a href="https://github.com/adeptmehdi" target="_blank" class="mobile-menu-item flex items-center gap-3 text-white hover:bg-blue-900/30 p-3 rounded-lg transition-all">
          <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path>
          </svg>
          <span>GitHub Profile</span>
        </a>
        
        <?php if(isset($_SESSION['user_id'])) : ?>
          <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') : ?>
            <a href="<?php echo BASE_URL; ?>/admin" class="mobile-menu-item flex items-center gap-3 text-white hover:bg-blue-900/30 p-3 rounded-lg transition-all">
              <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
              <span>Admin</span>
            </a>
          <?php endif; ?>
          
          <a href="<?php echo BASE_URL; ?>/users/profile" class="mobile-menu-item flex items-center gap-3 text-white hover:bg-blue-900/30 p-3 rounded-lg transition-all">
            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            <span>Profile</span>
          </a>
          
          <!-- Enhanced Mobile New Post Button -->
          <a href="<?php echo BASE_URL; ?>/posts/add" class="mobile-menu-item flex items-center gap-3 text-white p-3 rounded-lg transition-all relative overflow-hidden bg-gradient-to-r from-blue-600/30 to-indigo-600/30 hover:from-blue-600/50 hover:to-indigo-600/50">
            <div class="flex items-center gap-3 relative z-10">
              <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
              </svg>
              <span class="font-medium">Create Post</span>
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full hover:translate-x-full transition-transform duration-1000 ease-in-out"></div>
          </a>
          
          <div class="pt-4 mt-4 border-t border-gray-800">
            <a href="<?php echo BASE_URL; ?>/users/logout" class="block w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white text-center font-medium py-3 px-4 rounded-lg shadow-md transition duration-300">
              <div class="flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span>Logout</span>
              </div>
            </a>
          </div>
        <?php else : ?>
          <a href="<?php echo BASE_URL; ?>/users/login" class="mobile-menu-item flex items-center gap-3 text-white hover:bg-blue-900/30 p-3 rounded-lg transition-all">
            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
            </svg>
            <span>Login</span>
          </a>
          
          <div class="pt-4 mt-4 border-t border-gray-800">
            <a href="<?php echo BASE_URL; ?>/users/register" class="block w-full bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white text-center font-medium py-3 px-4 rounded-lg shadow-md transition duration-300">
              <div class="flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                <span>Register</span>
              </div>
            </a>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  
  <main class="container mx-auto px-4 py-4 sm:py-6 flex-grow relative z-10"><?php flash('post_message'); ?> 