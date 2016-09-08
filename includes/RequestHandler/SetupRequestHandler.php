<?php

require_once('includes/RequestHandler/RequestHandlerInterface.php');
require_once('includes/Settings/GlobalSettings.php');

class SetupRequestHandler implements RequestHandlerInterface {
  public function handle() {
    if (isset($_POST['begin_setup'])) {
      require_once('includes/Setup/SetupController.php');
      $setup_controller = new SetupController();
      $setup_controller->setup();
      header('Location: index.php');
    }

    $content = file_get_contents('includes/View/setup.php');
    $title = 'Setup Hosts Manager';
    require_once('includes/View/template.php');
  }
}
