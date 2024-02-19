document.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('scroll', function () {
      animateElement('.SetsUsApart', 900); 
      animateElement('.team', 900); 
      animateElement('.founder', 900);
      animateElement('.join', 900);
    });
  
    function animateElement(selector, delay) {
      var elements = document.querySelectorAll(selector);
      elements.forEach(function (element) {
        var distanceFromTop = element.getBoundingClientRect().top;
        var offset = window.innerHeight * 0.8;
  
        if (distanceFromTop < offset) {
          setTimeout(function () {
            element.classList.add('active');
          }, delay);
        }
      });
    }
  });
  
  