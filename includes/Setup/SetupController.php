<?php

require_once('includes/Setup/SetupInterface.php');
require_once('includes/Setup/DbSetup.php');
require_once('includes/Setup/HostsSetup.php');

class SetupController implements SetupInterface {

  private $db_setup;
  private $hosts_setup;

  function __construct() {
    $this->db_setup = new DbSetup();
    $this->hosts_setup = new HostsSetup();
  }

  public function setup() {
    $this->db_setup->setup();
    $this->hosts_setup->setup();
  }
}
