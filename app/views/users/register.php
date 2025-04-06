<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="max-w-md mx-auto my-10">
  <div class="flex justify-center mb-6">
    <h1 class="text-3xl font-bold">Create Account</h1>
  </div>
  
  <div class="bg-white rounded-lg shadow-md p-6">
    <p class="text-gray-600 mb-6 text-center">Please fill out this form to register</p>
    
    <form action="<?php echo BASE_URL; ?>/users/register" method="post">
      <div class="mb-4">
        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
        <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?php echo (!empty($data['name_err'])) ? 'border-red-500' : ''; ?>" value="<?php echo $data['name']; ?>" placeholder="Enter Full Name">
        <span class="text-red-500 text-xs italic"><?php echo $data['name_err']; ?></span>
      </div>
      
      <div class="mb-4">
        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
        <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?php echo (!empty($data['email_err'])) ? 'border-red-500' : ''; ?>" value="<?php echo $data['email']; ?>" placeholder="Enter Email">
        <span class="text-red-500 text-xs italic"><?php echo $data['email_err']; ?></span>
      </div>
      
      <div class="mb-4">
        <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
        <input type="text" name="username" id="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?php echo (!empty($data['username_err'])) ? 'border-red-500' : ''; ?>" value="<?php echo $data['username']; ?>" placeholder="Enter Username">
        <span class="text-red-500 text-xs italic"><?php echo $data['username_err']; ?></span>
      </div>
      
      <div class="mb-4">
        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
        <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?php echo (!empty($data['password_err'])) ? 'border-red-500' : ''; ?>" value="<?php echo $data['password']; ?>" placeholder="Enter Password">
        <span class="text-red-500 text-xs italic"><?php echo $data['password_err']; ?></span>
      </div>
      
      <div class="mb-6">
        <label for="confirm_password" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
        <input type="password" name="confirm_password" id="confirm_password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?php echo (!empty($data['confirm_password_err'])) ? 'border-red-500' : ''; ?>" value="<?php echo $data['confirm_password']; ?>" placeholder="Confirm Password">
        <span class="text-red-500 text-xs italic"><?php echo $data['confirm_password_err']; ?></span>
      </div>
      
      <div class="flex items-center justify-between">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
          Register
        </button>
        <a href="<?php echo BASE_URL; ?>/users/login" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
          Have an account? Login
        </a>
      </div>
    </form>
  </div>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?> 