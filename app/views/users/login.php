<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="max-w-md mx-auto my-10">
  <div class="flex justify-center mb-6">
    <h1 class="text-3xl font-bold">Login</h1>
  </div>
  
  <?php flash('register_success'); ?>
  
  <div class="bg-white rounded-lg shadow-md p-6">
    <p class="text-gray-600 mb-6 text-center">Please fill in your credentials to log in</p>
    
    <form action="<?php echo BASE_URL; ?>/users/login" method="post">
      <div class="mb-4">
        <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
        <input type="text" name="username" id="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?php echo (!empty($data['username_err'])) ? 'border-red-500' : ''; ?>" value="<?php echo $data['username']; ?>" placeholder="Enter Username">
        <span class="text-red-500 text-xs italic"><?php echo $data['username_err']; ?></span>
      </div>
      
      <div class="mb-6">
        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
        <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?php echo (!empty($data['password_err'])) ? 'border-red-500' : ''; ?>" placeholder="Enter Password">
        <span class="text-red-500 text-xs italic"><?php echo $data['password_err']; ?></span>
      </div>
      
      <div class="flex items-center justify-between">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
          Login
        </button>
        <a href="<?php echo BASE_URL; ?>/users/register" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
          No account? Register
        </a>
      </div>
    </form>
  </div>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?> 