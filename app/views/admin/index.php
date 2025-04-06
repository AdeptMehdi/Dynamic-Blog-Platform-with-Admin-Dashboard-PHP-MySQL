<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="mb-6">
  <h1 class="text-3xl font-bold">Admin Dashboard</h1>
  <p class="text-gray-600">Welcome to the admin dashboard, <?php echo $_SESSION['user_name']; ?>!</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
  <!-- Total Posts Card -->
  <div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex items-center justify-between">
      <div>
        <h2 class="text-xl font-semibold text-gray-800">Total Posts</h2>
        <p class="text-3xl font-bold text-blue-600 mt-2"><?php echo $data['totalPosts']; ?></p>
      </div>
      <div class="bg-blue-100 p-3 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
        </svg>
      </div>
    </div>
    <div class="mt-4">
      <a href="<?php echo BASE_URL; ?>/admin/posts" class="text-blue-600 hover:text-blue-800 text-sm font-semibold">Manage Posts →</a>
    </div>
  </div>
  
  <!-- Draft Posts Card -->
  <div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex items-center justify-between">
      <div>
        <h2 class="text-xl font-semibold text-gray-800">Draft Posts</h2>
        <p class="text-3xl font-bold text-yellow-600 mt-2"><?php echo $data['totalPostsDraft']; ?></p>
      </div>
      <div class="bg-yellow-100 p-3 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
        </svg>
      </div>
    </div>
    <div class="mt-4">
      <a href="<?php echo BASE_URL; ?>/admin/posts/add" class="text-yellow-600 hover:text-yellow-800 text-sm font-semibold">Create New Post →</a>
    </div>
  </div>
  
  <!-- Total Users Card -->
  <div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex items-center justify-between">
      <div>
        <h2 class="text-xl font-semibold text-gray-800">Total Users</h2>
        <p class="text-3xl font-bold text-green-600 mt-2"><?php echo $data['totalUsers']; ?></p>
      </div>
      <div class="bg-green-100 p-3 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
      </div>
    </div>
    <div class="mt-4">
      <a href="<?php echo BASE_URL; ?>/users/dashboard" class="text-green-600 hover:text-green-800 text-sm font-semibold">Manage Users →</a>
    </div>
  </div>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
  <h2 class="text-xl font-semibold text-gray-800 mb-4">Quick Actions</h2>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <a href="<?php echo BASE_URL; ?>/admin/posts/add" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100">
      <div class="bg-blue-100 p-3 rounded-full mr-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
      </div>
      <div>
        <h3 class="font-semibold text-gray-800">Add New Post</h3>
        <p class="text-sm text-gray-600">Create a new blog post</p>
      </div>
    </a>
    
    <a href="<?php echo BASE_URL; ?>/users/dashboard" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100">
      <div class="bg-green-100 p-3 rounded-full mr-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
      </div>
      <div>
        <h3 class="font-semibold text-gray-800">Manage Users</h3>
        <p class="text-sm text-gray-600">View and manage users</p>
      </div>
    </a>
  </div>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?> 