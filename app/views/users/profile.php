<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="container mx-auto px-4 py-8">
  <div class="flex flex-col md:flex-row gap-6">
    <!-- User Profile Card -->
    <div class="md:w-1/3">
      <div class="glass-effect rounded-lg shadow-xl p-6 border-t border-l border-white border-opacity-20 profile-card">
        <div class="text-center">
          <div class="profile-avatar h-28 w-28 rounded-full flex items-center justify-center text-white text-3xl font-bold mx-auto mb-6 shadow-lg ring-4 ring-white ring-opacity-20">
            <?php echo substr($data['user']->name, 0, 1); ?>
          </div>
          <h2 class="text-2xl font-bold text-white mb-1"><?php echo $data['user']->name; ?></h2>
          <p class="text-gray-300 mb-2">@<?php echo $data['user']->username; ?></p>
          <?php if($data['user']->role == 'admin') : ?>
            <span class="inline-block bg-gradient-to-r from-purple-500 to-indigo-600 text-white text-xs px-3 py-1 rounded-full font-medium shadow-sm">Admin</span>
          <?php endif; ?>
          
          <div class="mt-6 pt-4 border-t border-gray-700 border-opacity-50">
            <div class="text-gray-300 flex items-center justify-center gap-2 mb-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
              </svg>
              <span><?php echo $data['user']->email; ?></span>
            </div>
            <div class="text-gray-300 flex items-center justify-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
              </svg>
              <span>Joined <?php echo date('F j, Y', strtotime($data['user']->created_at)); ?></span>
            </div>
          </div>
        </div>
      </div>
      
      <?php if($data['user']->id == $_SESSION['user_id']) : ?>
        <div class="mt-6 glass-effect rounded-lg shadow-xl p-6 border-t border-l border-white border-opacity-20 profile-card">
          <h3 class="text-xl font-bold text-white mb-4 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
            </svg>
            Account Options
          </h3>
          <div class="space-y-3">
            <a href="<?php echo BASE_URL; ?>/posts/add" class="profile-link-button flex items-center justify-center py-2 px-4 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-md text-center transition duration-300 shadow-md">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
              </svg>
              Create New Post
            </a>
            <?php if($data['user']->role == 'admin') : ?>
              <a href="<?php echo BASE_URL; ?>/admin" class="profile-link-button flex items-center justify-center py-2 px-4 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white rounded-md text-center transition duration-300 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                </svg>
                Admin Dashboard
              </a>
            <?php endif; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
    
    <!-- User Posts -->
    <div class="md:w-2/3">
      <div class="glass-effect rounded-lg shadow-xl p-6 border-t border-l border-white border-opacity-20 profile-card">
        <h3 class="text-xl font-bold text-white mb-6 flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
          </svg>
          <?php echo ($data['user']->id == $_SESSION['user_id']) ? 'Your Posts' : $data['user']->name . '\'s Posts'; ?>
        </h3>
        
        <?php if(empty($data['posts'])) : ?>
          <div class="bg-gray-900 bg-opacity-50 p-6 rounded-lg border border-gray-700">
            <p class="text-gray-300 text-center flex flex-col items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-500 mb-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm0 2h10v7h-2l-1 2H8l-1-2H5V5z" clip-rule="evenodd" />
              </svg>
              No posts yet.
            </p>
          </div>
        <?php else : ?>
          <div class="space-y-5">
            <?php foreach($data['posts'] as $post) : ?>
              <div class="post-item border border-gray-700 border-opacity-50 rounded-lg p-5 hover:bg-gray-800 hover:bg-opacity-30 transition duration-300 shadow-md">
                <div class="flex justify-between items-start">
                  <h4 class="text-lg font-semibold text-white">
                    <a href="<?php echo BASE_URL; ?>/posts/show/<?php echo $post->id; ?>" class="post-title hover:text-blue-400 transition duration-300">
                      <?php echo $post->title; ?>
                    </a>
                  </h4>
                  <div>
                    <?php if($post->status == 'published') : ?>
                      <span class="inline-block bg-green-500 bg-opacity-20 text-green-400 text-xs px-2 py-1 rounded-full">Published</span>
                    <?php else : ?>
                      <span class="inline-block bg-yellow-500 bg-opacity-20 text-yellow-400 text-xs px-2 py-1 rounded-full">Draft</span>
                    <?php endif; ?>
                  </div>
                </div>
                
                <p class="text-sm text-gray-400 mt-2 flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                  </svg>
                  <?php echo date('F j, Y', strtotime($post->created_at)); ?>
                </p>
                
                <p class="text-gray-300 mt-3">
                  <?php echo substr(strip_tags($post->body), 0, 150) . '...'; ?>
                </p>
                
                <?php if($data['user']->id == $_SESSION['user_id'] || $_SESSION['user_role'] == 'admin') : ?>
                  <div class="mt-4 flex space-x-3">
                    <a href="<?php echo BASE_URL; ?>/posts/edit/<?php echo $post->id; ?>" class="profile-link-button py-1.5 px-4 bg-yellow-600 hover:bg-yellow-700 text-white text-sm rounded-md flex items-center transition duration-300 shadow-sm">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                      </svg>
                      Edit
                    </a>
                    <form action="<?php echo BASE_URL; ?>/posts/delete/<?php echo $post->id; ?>" method="POST" class="inline">
                      <button type="submit" onclick="return confirm('Are you sure you want to delete this post?');" class="profile-link-button py-1.5 px-4 bg-red-600 hover:bg-red-700 text-white text-sm rounded-md flex items-center transition duration-300 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
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
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?> 