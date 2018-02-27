$(document).ready(function() {
  var dirArray = document.getElementsByClassName('direction');

  if (dirArray.length) {
    for (var i=0; i<dirArray.length; i++) {
      dirArray[i].addEventListener('click', function() {
        var clicked = this,
          images = [],
          node = clicked.parentNode.firstChild,
          show,
          hide,
          position,
          count = 0,
          prev,
          next;
        while(node && node.nodeType === Node.ELEMENT_NODE) {
          node = node.nextElementSibling || node.nextSibling;
          if (node && node.classList.contains('post-image')) {
            if (!node.classList.contains('hidden')) {
              hide = node;
              if (clicked.classList.contains('direction-next')) {
                show = hide.nextElementSibling;
                prev = clicked.previousElementSibling;
                next = clicked;
                position = count + 1;
              }
              else if (clicked.classList.contains('direction-prev')) {
                show = hide.previousElementSibling;
                prev = clicked;
                next = clicked.nextElementSibling;
                position = count - 1;
              }
            }
            count++;
          }
        }
        hide.classList.add('hidden');
        show.classList.remove('hidden');
        if (position === 0) {
          prev.classList.add('hidden');
        }
        else {
          prev.classList.remove('hidden');
        }

        if (position === count - 1) {
          next.classList.add('hidden');
        }
        else {
          next.classList.remove('hidden');
        }
      });
    }
  }
});
