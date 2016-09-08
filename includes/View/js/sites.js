$(document).ready(function() {
  $('.js-sites-delete').click(function() {
    var id = $(this).data('id');

    if (!confirm('Are you sure you want to delete this site?')) {
      return;
    }

    var post_data = {
      'delete_site' : id
    };

    $.post( "index.php?r=sites", post_data, function( data ) {
      document.location = 'index.php?r=sites'
    });
  });

  $('.js-database-toggle').click(function() {
    if($(this).is(':checked')) {
      $('.js-database-fields').removeClass('hidden');
    } else {
      $('.js-database-fields').addClass('hidden');
    }
  });
});
