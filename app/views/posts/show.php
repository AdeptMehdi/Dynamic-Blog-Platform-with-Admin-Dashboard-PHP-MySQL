<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="container mx-auto px-4 py-8">
  <div class="mb-8">
    <a href="<?php echo BASE_URL; ?>/posts" class="inline-flex items-center gap-2 text-blue-400 hover:text-blue-300 transition duration-300 group">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:-translate-x-1 transition duration-300" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
      </svg>
      <span>Back to Posts</span>
    </a>
  </div>
  
  <article class="max-w-4xl mx-auto">
    <!-- Post Header -->
    <header class="mb-8">
      <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 leading-tight"><?php echo $data['post']->title; ?></h1>
      
      <div class="flex flex-wrap items-center gap-4 text-gray-300 mb-6">
        <div class="flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 005 10a6 6 0 0012 0c0-.862-.171-1.684-.486-2.436A5 5 0 0010 11z" clip-rule="evenodd" />
          </svg>
          <span>By <a href="<?php echo BASE_URL; ?>/users/profile/<?php echo $data['post']->user_id; ?>" class="font-medium text-blue-400 hover:text-blue-300 transition"><?php echo $data['post']->name; ?></a></span>
        </div>
        
        <div class="flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
          </svg>
          <time datetime="<?php echo date('Y-m-d', strtotime($data['post']->created_at)); ?>">
            <?php echo date('F j, Y', strtotime($data['post']->created_at)); ?>
          </time>
        </div>
      </div>
      
      <?php if(isset($_SESSION['user_id']) && ($data['post']->user_id == $_SESSION['user_id'] || $_SESSION['user_role'] == 'admin')) : ?>
        <div class="flex flex-wrap gap-3 mb-6">
          <a href="<?php echo BASE_URL; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="profile-link-button flex items-center gap-2 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white py-2 px-4 rounded-md shadow-md transition duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
            </svg>
            <span>Edit Post</span>
          </a>
          
          <form action="<?php echo BASE_URL; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="POST" class="inline">
            <button type="submit" onclick="return confirm('Are you sure you want to delete this post? This action cannot be undone.');" class="profile-link-button flex items-center gap-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white py-2 px-4 rounded-md shadow-md transition duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
              </svg>
              <span>Delete Post</span>
            </button>
          </form>
        </div>
      <?php endif; ?>
    </header>

    <!-- Featured Image -->
    <?php if($data['post']->image != 'noimage.jpg') : ?>
      <div class="mb-10 rounded-xl overflow-hidden shadow-2xl relative">
        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent pointer-events-none"></div>
        <img class="w-full h-auto max-h-[600px] object-cover transition duration-700 hover:scale-105 transform" src="<?php echo BASE_URL; ?>/public/uploads/<?php echo $data['post']->image; ?>" alt="<?php echo $data['post']->title; ?>">
      </div>
    <?php endif; ?>
    
    <!-- Post Content -->
    <div class="glass-effect p-6 md:p-8 rounded-xl shadow-xl mb-10 border-t border-l border-white border-opacity-20">
      <div class="prose prose-lg max-w-none">
        <?php echo $data['post']->body; ?>
      </div>
    </div>
    
    <!-- Post Footer - Tags, Share, etc. -->
    <footer class="glass-effect p-6 rounded-xl shadow-md border-t border-l border-white border-opacity-20">
      <div class="flex flex-wrap justify-between items-center gap-4">
        <div>
          <h4 class="text-white text-sm mb-2">Share this post:</h4>
          <div class="flex gap-3">
            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(BASE_URL . '/posts/show/' . $data['post']->id); ?>&text=<?php echo urlencode($data['post']->title); ?>" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-blue-500 hover:bg-blue-600 flex items-center justify-center text-white transition duration-300" aria-label="Share on Twitter">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
              </svg>
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(BASE_URL . '/posts/show/' . $data['post']->id); ?>" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-blue-700 hover:bg-blue-800 flex items-center justify-center text-white transition duration-300" aria-label="Share on Facebook">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
              </svg>
            </a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(BASE_URL . '/posts/show/' . $data['post']->id); ?>" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-blue-900 hover:bg-blue-950 flex items-center justify-center text-white transition duration-300" aria-label="Share on LinkedIn">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452z"></path>
              </svg>
            </a>
          </div>
        </div>
        
        <a href="<?php echo BASE_URL; ?>/posts" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-4 py-2 rounded-md flex items-center gap-2 shadow-md transition duration-300">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
          </svg>
          <span>All Posts</span>
        </a>
      </div>
    </footer>
  </article>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?> 