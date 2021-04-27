//Smooth scroll
$(document).ready(function() {
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function() {

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });

  $('.masthead')
    .visibility({
      once: false,
      onBottomPassed: function() {
        $('.fixed.menu').transition('slide down');
      },
      onBottomPassedReverse: function() {
        $('.fixed.menu').transition('slide down');
      }
    });

  $('.ui.sidebar')
    .sidebar('attach events', '.toc.item');

  $('img.zoom')
    .wrap('<span style="display:inline-block"></span>')
    .css('display', 'block')
    .parent()
    .zoom({
      on: 'grab'
    });

  $('.ui.selection.dropdown').dropdown({
    clearable: true
  });

  $(' .ui.inline.dropdown').dropdown({
    clearable: true,
    placeholder: 'any'
  });

  $('.ui.checkbox').checkbox();
});

function toggle(source) {
  checkboxes = $(source).closest('table').find('td input.checkbox');
  for (var i = 0, n = checkboxes.length; i < n; i++) {
    checkboxes[i].checked = source.checked;
  }
}

var categorySelect = document.getElementsByClassName('categorySelect');

for(var i = 0; i < categorySelect.length; i++) {
  (function(index) {
    categorySelect[index].addEventListener("change", function(evt) {
      $(categorySelect[index]).closest(".container").find(".portfolioCard").hide();
      $(categorySelect[index]).closest(".container").find("." + categorySelect[index].value + "category").show();
      if (categorySelect[index].value === "") {
        $(categorySelect[index]).closest(".container").find(".portfolioCard").show();
      }
     })
  })(i);
}
