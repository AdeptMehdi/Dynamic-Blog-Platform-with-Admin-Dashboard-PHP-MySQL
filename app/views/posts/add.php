<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="post-creation-container p-6 md:p-8 max-w-4xl mx-auto mb-10">
  <div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-white">Create New Post</h1>
    <a href="<?php echo BASE_URL; ?>/posts" class="flex items-center gap-2 bg-gray-700/50 hover:bg-gray-600/50 text-gray-100 font-medium py-2 px-4 rounded-lg transition-all duration-300 backdrop-blur-sm">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
      </svg>
      Back to Posts
    </a>
  </div>

  <form action="<?php echo BASE_URL; ?>/posts/add" method="post" enctype="multipart/form-data" class="space-y-6">
    <!-- Title Input -->
    <div>
      <label for="title" class="block text-gray-200 text-sm font-medium mb-2">Post Title</label>
      <input type="text" name="title" id="title" 
        class="post-form-input post-title-input <?php echo (!empty($data['title_err'])) ? 'border-red-500' : ''; ?>" 
        value="<?php echo $data['title']; ?>" 
        placeholder="Enter an engaging title for your post">
      <?php if(!empty($data['title_err'])): ?>
        <div class="mt-1 flex items-center text-red-400 text-sm">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
          </svg>
          <?php echo $data['title_err']; ?>
        </div>
      <?php endif; ?>
    </div>
    
    <!-- Editor Toolbar -->
    <div class="editor-toolbar">
      <button type="button" class="format-bold" title="Bold">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"></path>
          <path d="M6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"></path>
        </svg>
      </button>
      <button type="button" class="format-italic" title="Italic">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="19" y1="4" x2="10" y2="4"></line>
          <line x1="14" y1="20" x2="5" y2="20"></line>
          <line x1="15" y1="4" x2="9" y2="20"></line>
        </svg>
      </button>
      <button type="button" class="format-heading" title="Heading">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M6 4v16"></path>
          <path d="M18 4v16"></path>
          <path d="M6 12h12"></path>
        </svg>
      </button>
      <button type="button" class="format-paragraph" title="Paragraph">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M13 4v16"></path>
          <path d="M17 4h-9.5a4.5 4.5 0 0 0 0 9H13"></path>
        </svg>
      </button>
      <button type="button" class="format-link" title="Link">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
          <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
        </svg>
      </button>
    </div>
    
    <!-- Content Textarea -->
    <div>
      <label for="body" class="block text-gray-200 text-sm font-medium mb-2">Post Content</label>
      <textarea name="body" id="body" rows="12" 
        class="post-form-input post-body-textarea <?php echo (!empty($data['body_err'])) ? 'border-red-500' : ''; ?>" 
        placeholder="Write your amazing content here..."><?php echo $data['body']; ?></textarea>
      <div class="mt-1 text-gray-400 text-xs">
        You can use HTML tags to format your content.
      </div>
      <?php if(!empty($data['body_err'])): ?>
        <div class="mt-1 flex items-center text-red-400 text-sm">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
          </svg>
          <?php echo $data['body_err']; ?>
        </div>
      <?php endif; ?>
    </div>
    
    <!-- Image Upload -->
    <div class="bg-gray-800/30 p-5 rounded-lg backdrop-blur-sm">
      <label for="image" class="block text-gray-200 text-sm font-medium mb-3">Featured Image</label>
      <div class="file-upload-btn">
        <div class="file-upload-text bg-indigo-600 hover:bg-indigo-700 transition-all flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
          </svg>
          Choose Image
        </div>
        <input type="file" name="image" id="image" accept="image/*">
      </div>
      <div id="file-name" class="file-name-display">No file chosen</div>
      <p class="mt-2 text-gray-400 text-sm">Upload a high-quality image to make your post stand out. Recommended size: 1200 x 630 pixels.</p>
    </div>
    
    <!-- Submit Button -->
    <div class="pt-4">
      <button type="submit" class="post-submit-btn">
        Publish Post
      </button>
    </div>
  </form>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // File Upload Display
    const fileInput = document.getElementById('image');
    const fileNameDisplay = document.getElementById('file-name');
    
    fileInput.addEventListener('change', function() {
      if (this.files.length > 0) {
        fileNameDisplay.textContent = this.files[0].name;
        fileNameDisplay.classList.add('text-blue-400');
      } else {
        fileNameDisplay.textContent = 'No file chosen';
        fileNameDisplay.classList.remove('text-blue-400');
      }
    });
    
    // Editor Functionality
    const bodyField = document.getElementById('body');
    
    // Bold button
    const boldBtn = document.querySelector('.format-bold');
    if (boldBtn) {
      boldBtn.addEventListener('click', function() {
        surroundText(bodyField, '<strong>', '</strong>');
      });
    }
    
    // Italic button
    const italicBtn = document.querySelector('.format-italic');
    if (italicBtn) {
      italicBtn.addEventListener('click', function() {
        surroundText(bodyField, '<em>', '</em>');
      });
    }
    
    // Heading button
    const headingBtn = document.querySelector('.format-heading');
    if (headingBtn) {
      headingBtn.addEventListener('click', function() {
        surroundText(bodyField, '<h2>', '</h2>');
      });
    }
    
    // Paragraph button
    const paragraphBtn = document.querySelector('.format-paragraph');
    if (paragraphBtn) {
      paragraphBtn.addEventListener('click', function() {
        surroundText(bodyField, '<p>', '</p>');
      });
    }
    
    // Link button
    const linkBtn = document.querySelector('.format-link');
    if (linkBtn) {
      linkBtn.addEventListener('click', function() {
        const url = prompt('Enter the URL:');
        if (url) {
          surroundText(bodyField, '<a href="' + url + '">', '</a>');
        }
      });
    }
    
    // Helper function
    function surroundText(field, openTag, closeTag) {
      const start = field.selectionStart;
      const end = field.selectionEnd;
      const selectedText = field.value.substring(start, end);
      const beforeText = field.value.substring(0, start);
      const afterText = field.value.substring(end);
      
      field.value = beforeText + openTag + selectedText + closeTag + afterText;
      
      // Reset focus and selection
      field.focus();
      field.setSelectionRange(start + openTag.length, start + openTag.length + selectedText.length);
    }
  });
</script>

<?php require APPROOT . '/views/includes/footer.php'; ?> 