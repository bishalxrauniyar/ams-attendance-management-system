
function selectNavLink(event, url) {
  var links = document.querySelectorAll('.nav-bar a');
  links.forEach(function(link) {
      link.classList.remove('selected');
  });
  event.target.classList.add('selected');
  document.getElementById("contentFrame").src = url;
}
//locking the dashboard by default 

window.addEventListener('DOMContentLoaded', function() {
    var defaultNavLink = document.querySelector('.nav-bar a:first-child');
    defaultNavLink.classList.add('selected');
  var defaultUrl = defaultNavLink.getAttribute('href');
document.getElementById("myFrame").src = defaultUrl;
});

