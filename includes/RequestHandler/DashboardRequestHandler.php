<?php

require_once('includes/RequestHandler/RequestHandlerInterface.php');

class DashboardRequestHandler implements RequestHandlerInterface {
  public function handle() {
    $content = file_get_contents('includes/View/dashboard.php');
    $title = 'Hosts Manager';
    require_once('includes/View/template.php');
  }
}
