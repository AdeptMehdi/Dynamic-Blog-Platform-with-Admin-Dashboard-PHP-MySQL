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
  
  // Header scroll animation
  const header = document.getElementById('animated-header');
  let lastScrollTop = 0;
  
  window.addEventListener('scroll', function() {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    
    if (scrollTop > 50) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
    
    lastScrollTop = scrollTop;
  });

  // NEW Mobile Menu Implementation
  const hamburgerButton = document.getElementById('hamburger-menu');
  const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
  const mobileMenuDrawer = document.getElementById('mobile-menu-drawer');
  const mobileMenuClose = document.getElementById('mobile-menu-close');
  
  // Function to open the mobile menu
  function openMobileMenu() {
    hamburgerButton.classList.add('active');
    mobileMenuOverlay.classList.add('active');
    mobileMenuOverlay.classList.remove('hidden');
    mobileMenuDrawer.classList.add('active');
    document.body.style.overflow = 'hidden'; // Prevent scrolling
  }
  
  // Function to close the mobile menu
  function closeMobileMenu() {
    hamburgerButton.classList.remove('active');
    mobileMenuOverlay.classList.remove('active');
    mobileMenuDrawer.classList.remove('active');
    document.body.style.overflow = ''; // Allow scrolling
    
    // Hide the overlay after transition
    setTimeout(() => {
      mobileMenuOverlay.classList.add('hidden');
    }, 300);
  }
  
  // Toggle mobile menu when hamburger button is clicked
  if (hamburgerButton) {
    hamburgerButton.addEventListener('click', function(e) {
      e.preventDefault();
      if (this.classList.contains('active')) {
        closeMobileMenu();
      } else {
        openMobileMenu();
      }
    });
  }
  
  // Close mobile menu when close button is clicked
  if (mobileMenuClose) {
    mobileMenuClose.addEventListener('click', function(e) {
      e.preventDefault();
      closeMobileMenu();
    });
  }
  
  // Close mobile menu when overlay is clicked
  if (mobileMenuOverlay) {
    mobileMenuOverlay.addEventListener('click', function() {
      closeMobileMenu();
    });
  }
  
  // Close mobile menu when ESC key is pressed
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && hamburgerButton && hamburgerButton.classList.contains('active')) {
      closeMobileMenu();
    }
  });
  
  // Close mobile menu when window is resized to desktop size
  window.addEventListener('resize', function() {
    if (window.innerWidth >= 768 && hamburgerButton && hamburgerButton.classList.contains('active')) {
      closeMobileMenu();
    }
  });
  
  // Add click event listeners to all mobile menu items
  const mobileMenuItems = document.querySelectorAll('.mobile-menu-item');
  mobileMenuItems.forEach(item => {
    item.addEventListener('click', function() {
      // Don't close menu if it opens in a new tab or has no href
      if (this.getAttribute('target') !== '_blank' && this.getAttribute('href')) {
        closeMobileMenu();
      }
    });
  });

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