<!doctype html>
<html>
  <head>
    <title><?php print $title; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <?php if (!empty($js)): ?>
      <?php foreach ($js as $src): ?>
        <script src="<?php print $src; ?>"></script>
      <?php endforeach; ?>
    <?php endif; ?>
  </head>

  <body class="js-body-<?php print $path; ?>">
    <div>
      <nav class="navbar navbar-default">
        <div class="container">
          <div class="navbar-header">
            <a class="navbar-brand" href="index.php?r=dashboard">Hosts Manager</a>
          </div>
          <div id="navbar">
            <ul class="nav navbar-nav navbar-right">
              <li <?php if (!isset($_GET['r']) || $_GET['r'] == 'dashboard') { print 'class="active"'; } ?>><a href="index.php?r=dashboard">Dashboard</a></li>
              <li <?php if (isset($_GET['r']) && $_GET['r'] == 'hosts') { print 'class="active"'; } ?>><a href="index.php?r=hosts">Hosts</a></li>
              <li <?php if (isset($_GET['r']) && $_GET['r'] == 'sites') { print 'class="active"'; } ?>><a href="index.php?r=sites">Sites</a></li>
              <li><a href="phpmyadmin" target="_blank" rel="noopener">phpMyAdmin</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>

    <div class="container">
      <?php print $content; ?>
    </div>
  </body>
</html>
