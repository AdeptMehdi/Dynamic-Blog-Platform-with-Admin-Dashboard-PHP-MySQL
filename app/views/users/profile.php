<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="flex flex-col md:flex-row gap-6">
  <!-- User Profile Card -->
  <div class="md:w-1/3">
    <div class="bg-white rounded-lg shadow-md p-6">
      <div class="text-center">
        <div class="h-24 w-24 rounded-full bg-blue-500 flex items-center justify-center text-white text-3xl font-bold mx-auto mb-4">
          <?php echo substr($data['user']->name, 0, 1); ?>
        </div>
        <h2 class="text-2xl font-bold text-gray-800"><?php echo $data['user']->name; ?></h2>
        <p class="text-gray-600 mb-2">@<?php echo $data['user']->username; ?></p>
        <?php if($data['user']->role == 'admin') : ?>
          <span class="admin-badge">Admin</span>
        <?php endif; ?>
        
        <div class="mt-4 pt-4 border-t border-gray-200">
          <p class="text-gray-600">
            <span class="font-semibold">Email:</span> <?php echo $data['user']->email; ?>
          </p>
          <p class="text-gray-600">
            <span class="font-semibold">Joined:</span> <?php echo date('F j, Y', strtotime($data['user']->created_at)); ?>
          </p>
        </div>
      </div>
    </div>
    
    <?php if($data['user']->id == $_SESSION['user_id']) : ?>
      <div class="mt-4 bg-white rounded-lg shadow-md p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Account Options</h3>
        <div class="space-y-2">
          <a href="<?php echo BASE_URL; ?>/posts/add" class="block py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white rounded text-center">
            Create New Post
          </a>
          <?php if($data['user']->role == 'admin') : ?>
            <a href="<?php echo BASE_URL; ?>/admin" class="block py-2 px-4 bg-green-500 hover:bg-green-600 text-white rounded text-center">
              Admin Dashboard
            </a>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
  
  <!-- User Posts -->
  <div class="md:w-2/3">
    <div class="bg-white rounded-lg shadow-md p-6">
      <h3 class="text-xl font-bold text-gray-800 mb-4">
        <?php echo ($data['user']->id == $_SESSION['user_id']) ? 'Your Posts' : $data['user']->name . '\'s Posts'; ?>
      </h3>
      
      <?php if(empty($data['posts'])) : ?>
        <div class="bg-gray-100 p-4 rounded">
          <p class="text-gray-600 text-center">No posts yet.</p>
        </div>
      <?php else : ?>
        <div class="space-y-4">
          <?php foreach($data['posts'] as $post) : ?>
            <div class="border border-gray-200 rounded p-4 hover:bg-gray-50">
              <div class="flex justify-between items-start">
                <h4 class="text-lg font-semibold text-gray-800">
                  <a href="<?php echo BASE_URL; ?>/posts/show/<?php echo $post->id; ?>" class="hover:text-blue-600">
                    <?php echo $post->title; ?>
                  </a>
                </h4>
                <div>
                  <?php if($post->status == 'published') : ?>
                    <span class="status-published">Published</span>
                  <?php else : ?>
                    <span class="status-draft">Draft</span>
                  <?php endif; ?>
                </div>
              </div>
              <p class="text-sm text-gray-600 mt-2">
                Posted on <?php echo date('F j, Y', strtotime($post->created_at)); ?>
              </p>
              <p class="text-gray-600 mt-2">
                <?php echo substr(strip_tags($post->body), 0, 100) . '...'; ?>
              </p>
              
              <?php if($data['user']->id == $_SESSION['user_id'] || $_SESSION['user_role'] == 'admin') : ?>
                <div class="mt-3 flex space-x-2">
                  <a href="<?php echo BASE_URL; ?>/posts/edit/<?php echo $post->id; ?>" class="py-1 px-3 bg-yellow-500 hover:bg-yellow-600 text-white text-sm rounded">
                    Edit
                  </a>
                  <form action="<?php echo BASE_URL; ?>/posts/delete/<?php echo $post->id; ?>" method="POST" class="inline">
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this post?');" class="py-1 px-3 bg-red-500 hover:bg-red-600 text-white text-sm rounded delete-btn">
                      Delete
                    </button>
                  </form>
                </div>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?> 