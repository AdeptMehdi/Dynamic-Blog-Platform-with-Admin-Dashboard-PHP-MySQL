<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="flex justify-between items-start mb-6">
  <a href="<?php echo BASE_URL; ?>/posts" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded">
    <i class="fas fa-arrow-left"></i> Back to Posts
  </a>
  
  <?php if(isset($_SESSION['user_id']) && ($data['post']->user_id == $_SESSION['user_id'] || $_SESSION['user_role'] == 'admin')) : ?>
    <div class="flex space-x-2">
      <a href="<?php echo BASE_URL; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
        <i class="fas fa-edit"></i> Edit
      </a>
      
      <form action="<?php echo BASE_URL; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this post?');">
        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
          <i class="fas fa-trash"></i> Delete
        </button>
      </form>
    </div>
  <?php endif; ?>
</div>

<article class="bg-white rounded-lg shadow-md overflow-hidden">
  <?php if($data['post']->image != 'noimage.jpg') : ?>
    <div class="w-full h-64 md:h-96 overflow-hidden">
      <img class="w-full h-full object-cover" src="<?php echo BASE_URL; ?>/public/uploads/<?php echo $data['post']->image; ?>" alt="<?php echo $data['post']->title; ?>">
    </div>
  <?php endif; ?>
  
  <div class="p-6">
    <div class="flex justify-between items-start mb-4">
      <h1 class="text-3xl font-bold text-gray-900"><?php echo $data['post']->title; ?></h1>
      <span class="bg-gray-200 text-gray-700 text-xs px-2 py-1 rounded">
        <?php echo date('F j, Y', strtotime($data['post']->created_at)); ?>
      </span>
    </div>
    
    <div class="flex items-center mb-6">
      <div class="text-sm text-gray-600">
        Posted by <span class="font-semibold"><?php echo $data['post']->name; ?></span>
      </div>
    </div>
    
    <div class="prose max-w-none mb-6">
      <?php echo $data['post']->body; ?>
    </div>
  </div>
</article>

<?php require APPROOT . '/views/includes/footer.php'; ?> 