// Sign out functionality
include "../../assets/include/config.php";
$('#signOutBtn').click(function(e) {
  e.preventDefault();
  $.ajax({
    url: 'sign_out.php',
    method: 'POST',
    complete: function() {
      window.location.href = '../../index.php'; // Redirect to Home page
    }
  });
});