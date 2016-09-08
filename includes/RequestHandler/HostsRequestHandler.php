<?php

require_once('includes/RequestHandler/RequestHandlerInterface.php');
require_once('includes/Database/DbHelper.php');
require_once('includes/Writer/HostsFileWriter.php');

class HostsRequestHandler implements RequestHandlerInterface {
  public function handle() {
    $settings = GlobalSettings::getInstance();

    if (isset($_POST['add_site'])) {
      $this->add();
    }

    if (isset($_POST['delete_site'])) {
      $this->delete();
    }

    $this->render();
  }

  private function render() {
    $db = DbHelper::getDatabase();

    $result = $db->query('select * from hosts');

    $sites = array();
    if ($result->num_rows > 0) {
      while ($site = $result->fetch_assoc()) {
        $sites[] = $site;
      }
    }

    $db->close();
    
    ob_start();
    require_once('includes/View/hosts.php');
    $content = ob_get_contents();
    ob_end_clean();

    $title = 'Hosts Manager | Hosts';
    $path = 'sites';
    $js = array('includes/View/js/hosts.js');
    require_once('includes/View/template.php');
  }

  private function add() {
    $ip = $_POST['ip'];
    $domain = $_POST['domain'];

    $db = DbHelper::getDatabase();

    $stmt = $db->prepare("INSERT INTO hosts (ip, hostname) VALUES (?, ?)");
    if ($stmt) {
      $stmt->bind_param('ss', $ip, $domain);
      $stmt->execute();
    }

    $db->close();

    $hosts_file_writer = new HostsFileWriter();
    $hosts_file_writer->write();
  }

  private function delete() {
    $id = $_POST['delete_site'];

    $db = DbHelper::getDatabase();

    $stmt = $db->prepare("DELETE FROM hosts WHERE id=?");
    if ($stmt) {
      $stmt->bind_param('s', $id);
      $stmt->execute();
    }

    $db->close();

    $hosts_file_writer = new HostsFileWriter();
    $hosts_file_writer->write();
  }
}
