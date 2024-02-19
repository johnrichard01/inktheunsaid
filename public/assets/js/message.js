document.querySelector('.toggler-icon').addEventListener('click', function() {
    const navbar = document.querySelector('.custom-navbar');
    const content = document.querySelector('.custom-content');

    if (navbar.style.left === '-250px') {
      navbar.style.left = '0';
      content.style.marginLeft = '250px';
    } else {
      navbar.style.left = '-250px';
      content.style.marginLeft = '0';
    }
  });