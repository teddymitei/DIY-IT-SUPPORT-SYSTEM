 // JavaScript for handling the hamburger menu
 const menuIcon = document.getElementById('menu-icon');
 const navLinks = document.querySelector('.nav-links');

 menuIcon.addEventListener('click', () => {
     navLinks.classList.toggle('show');
 });