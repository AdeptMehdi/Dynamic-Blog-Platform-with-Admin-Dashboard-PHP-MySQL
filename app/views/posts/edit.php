<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="flex justify-between items-start mb-6">
  <h1 class="text-3xl font-bold">Edit Post</h1>
  <a href="<?php echo BASE_URL; ?>/posts/show/<?php echo $data['id']; ?>" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded">
    <i class="fas fa-arrow-left"></i> Back to Post
  </a>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
  <?php if(!empty($data['image']) && $data['image'] != 'noimage.jpg'): ?>
    <div class="mb-6">
      <p class="text-gray-700 text-sm font-bold mb-2">Current Image:</p>
      <img src="<?php echo BASE_URL; ?>/public/uploads/<?php echo $data['image']; ?>" alt="Current Image" class="w-full max-w-md h-auto">
    </div>
  <?php endif; ?>

  <form action="<?php echo BASE_URL; ?>/posts/edit/<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data">
    <div class="mb-4">
      <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
      <input type="text" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?php echo (!empty($data['title_err'])) ? 'border-red-500' : ''; ?>" value="<?php echo $data['title']; ?>" placeholder="Post Title">
      <span class="text-red-500 text-xs italic"><?php echo $data['title_err']; ?></span>
    </div>
    
    <div class="mb-4">
      <label for="body" class="block text-gray-700 text-sm font-bold mb-2">Content</label>
      <textarea name="body" id="body" rows="10" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?php echo (!empty($data['body_err'])) ? 'border-red-500' : ''; ?>" placeholder="Post Content"><?php echo $data['body']; ?></textarea>
      <span class="text-red-500 text-xs italic"><?php echo $data['body_err']; ?></span>
    </div>
    
    <div class="mb-4">
      <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image (Optional)</label>
      <input type="file" name="image" id="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
      <span class="text-gray-500 text-xs">Upload a new image to replace the current one. Leave empty to keep the current image.</span>
    </div>
    
    <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'): ?>
      <div class="mb-4">
        <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status</label>
        <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
          <option value="published" <?php echo ($data['status'] == 'published') ? 'selected' : ''; ?>>Published</option>
          <option value="draft" <?php echo ($data['status'] == 'draft') ? 'selected' : ''; ?>>Draft</option>
        </select>
      </div>
    <?php endif; ?>
    
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
      Update Post
    </button>
  </form>
</div>

<script>
  // Add a simple WYSIWYG editor for the content
  document.addEventListener('DOMContentLoaded', function() {
    const bodyField = document.getElementById('body');
    
    // Create a basic toolbar
    const toolbar = document.createElement('div');
    toolbar.className = 'flex space-x-2 border border-gray-300 p-2 mb-2 bg-gray-100 rounded';
    
    // Bold button
    const boldBtn = document.createElement('button');
    boldBtn.type = 'button';
    boldBtn.className = 'px-2 py-1 bg-white border border-gray-300 rounded hover:bg-gray-200';
    boldBtn.innerHTML = '<strong>B</strong>';
    boldBtn.onclick = function() {
      surroundText(bodyField, '<strong>', '</strong>');
    };
    
    // Italic button
    const italicBtn = document.createElement('button');
    italicBtn.type = 'button';
    italicBtn.className = 'px-2 py-1 bg-white border border-gray-300 rounded hover:bg-gray-200';
    italicBtn.innerHTML = '<em>I</em>';
    italicBtn.onclick = function() {
      surroundText(bodyField, '<em>', '</em>');
    };
    
    // Paragraph button
    const paragraphBtn = document.createElement('button');
    paragraphBtn.type = 'button';
    paragraphBtn.className = 'px-2 py-1 bg-white border border-gray-300 rounded hover:bg-gray-200';
    paragraphBtn.innerHTML = 'P';
    paragraphBtn.onclick = function() {
      surroundText(bodyField, '<p>', '</p>');
    };
    
    // Add buttons to toolbar
    toolbar.appendChild(boldBtn);
    toolbar.appendChild(italicBtn);
    toolbar.appendChild(paragraphBtn);
    
    // Insert toolbar before textarea
    bodyField.parentNode.insertBefore(toolbar, bodyField);
    
    // Function to surround selected text with tags
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