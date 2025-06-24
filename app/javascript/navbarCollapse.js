document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('menuToggle').addEventListener('click', function() {
    const navbar = document.querySelector('.navbar');
    const overlay = document.getElementById('overlay');
    
    navbar.classList.toggle('open');
    overlay.classList.toggle('open');
  });
  
  document.getElementById('overlay').addEventListener('click', function() {
    const navbar = document.querySelector('.navbar');
    const overlay = document.getElementById('overlay');
    
    navbar.classList.remove('open');
    overlay.classList.remove('open');
  });
  
  window.addEventListener('resize', function() {
    if (window.innerWidth > 768) {
      const navbar = document.querySelector('.navbar');
      const overlay = document.getElementById('overlay');
      
      navbar.classList.remove('open');
      overlay.classList.remove('open');
    }
  });
});