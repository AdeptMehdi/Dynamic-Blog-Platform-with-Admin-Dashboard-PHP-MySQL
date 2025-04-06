// Main JavaScript file

document.addEventListener('DOMContentLoaded', function() {
  // Flash message auto-dismiss
  const flashMessages = document.getElementById('msg-flash');
  if (flashMessages) {
    setTimeout(function() {
      flashMessages.style.opacity = '0';
      setTimeout(function() {
        flashMessages.style.display = 'none';
      }, 500);
    }, 3000);
  }

  // Confirm delete actions
  const deleteButtons = document.querySelectorAll('.delete-btn');
  if (deleteButtons) {
    deleteButtons.forEach(button => {
      button.addEventListener('click', function(e) {
        if (!confirm('Are you sure you want to delete this item? This action cannot be undone.')) {
          e.preventDefault();
        }
      });
    });
  }

  // Enhanced Mobile menu toggle with animation - Side menu from left
  const menuToggle = document.getElementById('menu-toggle');
  const closeMenu = document.getElementById('close-menu');
  const mobileMenu = document.getElementById('mobile-menu');
  const mobileOverlay = document.getElementById('mobile-overlay');
  
  if (menuToggle && mobileMenu) {
    let isOpen = false;
    
    // Function to open the menu
    const openMenu = () => {
      isOpen = true;
      
      // Show the menu with animation from left
      mobileMenu.classList.remove('-translate-x-full');
      mobileMenu.classList.add('translate-x-0');
      
      // Show overlay with fade in
      mobileOverlay.classList.remove('hidden');
      setTimeout(() => {
        mobileOverlay.classList.add('opacity-100');
        mobileOverlay.classList.remove('opacity-0');
      }, 10);
      
      // Change the menu icon to X
      menuToggle.innerHTML = `
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      `;
      
      // Add body class to prevent scrolling
      document.body.classList.add('overflow-hidden');
    };
    
    // Function to close the menu
    const closeMenuFunc = () => {
      isOpen = false;
      
      // Hide the menu with animation
      mobileMenu.classList.remove('translate-x-0');
      mobileMenu.classList.add('-translate-x-full');
      
      // Hide overlay with fade out
      mobileOverlay.classList.add('opacity-0');
      mobileOverlay.classList.remove('opacity-100');
      setTimeout(() => {
        mobileOverlay.classList.add('hidden');
      }, 300);
      
      // Change the menu icon back to hamburger
      menuToggle.innerHTML = `
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      `;
      
      // Remove body class to allow scrolling
      document.body.classList.remove('overflow-hidden');
    };
    
    // Open menu when toggle is clicked
    menuToggle.addEventListener('click', function() {
      if (isOpen) {
        closeMenuFunc();
      } else {
        openMenu();
      }
    });
    
    // Close menu when close button is clicked
    if (closeMenu) {
      closeMenu.addEventListener('click', closeMenuFunc);
    }
    
    // Close menu when overlay is clicked
    if (mobileOverlay) {
      mobileOverlay.addEventListener('click', closeMenuFunc);
    }
    
    // Close menu on window resize to desktop size
    window.addEventListener('resize', function() {
      if (window.innerWidth >= 768 && isOpen) {
        closeMenuFunc();
      }
    });

    // Close menu when clicking escape key
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && isOpen) {
        closeMenuFunc();
      }
    });
    
    // Close menu when clicking a menu item that navigates away
    const menuLinks = mobileMenu.querySelectorAll('a[href]:not([target="_blank"])');
    menuLinks.forEach(link => {
      link.addEventListener('click', () => {
        closeMenuFunc();
      });
    });
  }

  // Add simple text editor functionality for blog post creation/editing
  const editorToolbar = document.querySelector('.editor-toolbar');
  if (editorToolbar) {
    const contentArea = document.getElementById('body');
    
    // Bold button
    const boldBtn = editorToolbar.querySelector('.format-bold');
    if (boldBtn && contentArea) {
      boldBtn.addEventListener('click', function() {
        surroundText(contentArea, '<strong>', '</strong>');
      });
    }
    
    // Italic button
    const italicBtn = editorToolbar.querySelector('.format-italic');
    if (italicBtn && contentArea) {
      italicBtn.addEventListener('click', function() {
        surroundText(contentArea, '<em>', '</em>');
      });
    }
    
    // Paragraph button
    const paragraphBtn = editorToolbar.querySelector('.format-paragraph');
    if (paragraphBtn && contentArea) {
      paragraphBtn.addEventListener('click', function() {
        surroundText(contentArea, '<p>', '</p>');
      });
    }
    
    // Heading button
    const headingBtn = editorToolbar.querySelector('.format-heading');
    if (headingBtn && contentArea) {
      headingBtn.addEventListener('click', function() {
        surroundText(contentArea, '<h2>', '</h2>');
      });
    }
    
    // Link button
    const linkBtn = editorToolbar.querySelector('.format-link');
    if (linkBtn && contentArea) {
      linkBtn.addEventListener('click', function() {
        const url = prompt('Enter the URL:');
        if (url) {
          surroundText(contentArea, '<a href="' + url + '">', '</a>');
        }
      });
    }
  }
  
  // Animate elements on page load
  const animateElements = document.querySelectorAll('.blog-card');
  if (animateElements.length > 0) {
    animateElements.forEach((element, index) => {
      element.style.opacity = '0';
      element.style.transform = 'translateY(20px)';
      element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
      
      // Stagger the animations
      setTimeout(() => {
        element.style.opacity = '1';
        element.style.transform = 'translateY(0)';
      }, 100 * index);
    });
  }
  
  // Fix for any overflow issues with images
  const blogImages = document.querySelectorAll('img');
  if (blogImages.length > 0) {
    blogImages.forEach(img => {
      img.addEventListener('error', function() {
        this.style.display = 'none'; // Hide broken images
      });
      
      // Ensure images don't break layout
      img.addEventListener('load', function() {
        this.style.maxWidth = '100%';
        this.style.height = 'auto';
      });
    });
  }
  
  // Helper function to surround selected text with HTML tags
  function surroundText(field, openTag, closeTag) {
    if (!field) return;
    
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