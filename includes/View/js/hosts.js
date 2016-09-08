$(document).ready(function() {
  $('.js-hosts-delete').click(function() {
    var id = $(this).data('id');

    if (!confirm('Are you sure you want to delete this site?')) {
      return;
    }

    var post_data = {
      'delete_site' : id
    };

    $.post( "index.php?r=hosts", post_data, function( data ) {
      document.location = 'index.php?r=hosts'
    });
  });
});
