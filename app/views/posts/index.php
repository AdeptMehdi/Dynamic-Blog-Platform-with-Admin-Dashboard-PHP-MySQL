<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="relative z-10 mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
  <h1 class="text-3xl font-bold text-white">Latest <span class="text-blue-400">Blog Posts</span></h1>
  <?php if(isset($_SESSION['user_id'])) : ?>
    <a href="<?php echo BASE_URL; ?>/posts/add" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-lg transition duration-300 flex items-center transform hover:translate-y-[-2px]">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
      </svg>
      Create Post
    </a>
  <?php endif; ?>
</div>

<?php if(empty($data['posts'])) : ?>
  <div class="relative z-10 bg-white/10 backdrop-filter backdrop-blur-lg rounded-lg shadow-xl p-8 mb-6 transform transition-all duration-300 hover:scale-105 border border-white/20">
    <p class="text-white text-center text-lg">No posts available yet. Be the first to share your thoughts!</p>
  </div>
<?php else : ?>
  <div class="relative z-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <?php foreach($data['posts'] as $post) : ?>
      <div class="blog-card bg-white/10 backdrop-filter backdrop-blur-lg rounded-xl shadow-xl overflow-hidden border border-white/20 flex flex-col h-full">
        <div class="image-container">
          <img class="w-full h-full object-cover transition-transform duration-700 hover:scale-110" 
               src="<?php echo BASE_URL; ?>/uploads/<?php echo $post->image; ?>" 
               alt="<?php echo $post->title; ?>">
        </div>
        <div class="p-6 flex-grow content-area">
          <div class="flex justify-between items-start mb-2">
            <h2 class="text-xl font-bold text-white hover:text-blue-400 transition-colors duration-300">
              <a href="<?php echo BASE_URL; ?>/posts/show/<?php echo $post->id; ?>">
                <?php echo $post->title; ?>
              </a>
            </h2>
          </div>
          <span class="inline-block bg-blue-600/30 text-blue-200 text-xs px-3 py-1 rounded-full mb-3 backdrop-blur-sm border border-blue-500/30">
            <?php echo date('F j, Y', strtotime($post->created_at)); ?>
          </span>
          <p class="text-gray-300 mb-4 text-sm truncate-text"><?php echo substr(strip_tags($post->body), 0, 120) . '...'; ?></p>
        </div>
        <div class="px-6 pb-4 flex justify-between items-center border-t border-white/10 pt-4 mt-2">
          <a href="<?php echo BASE_URL; ?>/posts/show/<?php echo $post->id; ?>" class="text-blue-400 hover:text-blue-300 text-sm font-semibold flex items-center transition-colors duration-300">
            Read More
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
          </a>
          <div class="text-xs text-gray-400 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <?php echo $post->name; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Pagination -->
  <?php if($data['totalPages'] > 1) : ?>
    <div class="relative z-10 flex justify-center mt-8">
      <div class="flex flex-wrap gap-2 justify-center">
        <?php if($data['currentPage'] > 1) : ?>
          <a href="<?php echo BASE_URL; ?>/posts?page=<?php echo $data['currentPage'] - 1; ?>" class="px-4 py-2 bg-blue-600/20 text-white rounded-lg hover:bg-blue-600/40 transition-colors duration-300 backdrop-blur-sm border border-blue-500/30">Previous</a>
        <?php endif; ?>
        
        <?php for($i = 1; $i <= $data['totalPages']; $i++) : ?>
          <?php if($i == $data['currentPage']) : ?>
            <span class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md"><?php echo $i; ?></span>
          <?php else : ?>
            <a href="<?php echo BASE_URL; ?>/posts?page=<?php echo $i; ?>" class="px-4 py-2 bg-blue-600/20 text-white rounded-lg hover:bg-blue-600/40 transition-colors duration-300 backdrop-blur-sm border border-blue-500/30"><?php echo $i; ?></a>
          <?php endif; ?>
        <?php endfor; ?>
        
        <?php if($data['currentPage'] < $data['totalPages']) : ?>
          <a href="<?php echo BASE_URL; ?>/posts?page=<?php echo $data['currentPage'] + 1; ?>" class="px-4 py-2 bg-blue-600/20 text-white rounded-lg hover:bg-blue-600/40 transition-colors duration-300 backdrop-blur-sm border border-blue-500/30">Next</a>
        <?php endif; ?>
      </div>
    </div>
  <?php endif; ?>
<?php endif; ?>

<?php require APPROOT . '/views/includes/footer.php'; ?> 