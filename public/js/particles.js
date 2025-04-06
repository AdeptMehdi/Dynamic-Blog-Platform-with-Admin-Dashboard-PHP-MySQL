/**
 * Particles Canvas Background
 * A simple particle animation for the blog background
 */

document.addEventListener('DOMContentLoaded', function() {
  // Get the canvas element
  const canvas = document.getElementById('particles-canvas');
  if (!canvas) return;

  // Get the canvas context
  const ctx = canvas.getContext('2d');
  
  // Set canvas size to match the window
  function resizeCanvas() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
  }
  
  // Initialize canvas size
  resizeCanvas();
  
  // Add resize event listener
  window.addEventListener('resize', resizeCanvas);
  
  // Particle class
  class Particle {
    constructor() {
      this.reset();
    }
    
    reset() {
      // Random position
      this.x = Math.random() * canvas.width;
      this.y = Math.random() * canvas.height;
      
      // Random size
      this.size = Math.random() * 5 + 1;
      
      // Random speed
      this.speedX = Math.random() * 1 - 0.5;
      this.speedY = Math.random() * 1 - 0.5;
      
      // Random opacity
      this.alpha = Math.random() * 0.5 + 0.1;
      
      // Random color (blues)
      this.color = `rgba(66, 153, 225, ${this.alpha})`;
    }
    
    update() {
      // Move particle
      this.x += this.speedX;
      this.y += this.speedY;
      
      // Reset if particle goes off-screen
      if (this.x < 0 || this.x > canvas.width || this.y < 0 || this.y > canvas.height) {
        this.reset();
      }
    }
    
    draw() {
      // Draw particle
      ctx.fillStyle = this.color;
      ctx.beginPath();
      ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
      ctx.fill();
    }
  }
  
  // Create array of particles
  const particles = [];
  const particleCount = 100;
  
  for (let i = 0; i < particleCount; i++) {
    particles.push(new Particle());
  }
  
  // Animation function
  function animate() {
    // Clear canvas
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    // Update and draw particles
    for (let i = 0; i < particles.length; i++) {
      particles[i].update();
      particles[i].draw();
    }
    
    // Connect particles that are close to each other
    connectParticles();
    
    // Request next animation frame
    requestAnimationFrame(animate);
  }
  
  // Function to connect particles that are close to each other
  function connectParticles() {
    const maxDistance = 100;
    
    for (let i = 0; i < particles.length; i++) {
      for (let j = i; j < particles.length; j++) {
        const dx = particles[i].x - particles[j].x;
        const dy = particles[i].y - particles[j].y;
        const distance = Math.sqrt(dx * dx + dy * dy);
        
        if (distance < maxDistance) {
          // Calculate line opacity based on distance
          const opacity = 1 - (distance / maxDistance);
          
          // Draw line connecting particles
          ctx.beginPath();
          ctx.strokeStyle = `rgba(66, 153, 225, ${opacity * 0.2})`;
          ctx.lineWidth = 1;
          ctx.moveTo(particles[i].x, particles[i].y);
          ctx.lineTo(particles[j].x, particles[j].y);
          ctx.stroke();
        }
      }
    }
  }
  
  // Start animation
  animate();
}); 