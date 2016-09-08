<?php

require_once('includes/RequestHandler/RequestHandlerInterface.php');
require_once('includes/Database/DbHelper.php');
require_once('includes/Writer/HostsFileWriter.php');
require_once('includes/Writer/VHostFileWriter.php');

class SitesRequestHandler implements RequestHandlerInterface {
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

    $result = $db->query('
      select * from sites as s
      join sites_to_hosts as sth
        on s.id = sth.site_id
      join hosts as h
        on h.id = sth.host_id
    ');

    $sites = array();
    if ($result->num_rows > 0) {
      while ($site = $result->fetch_assoc()) {
        $sites[] = $site;
      }
    }
    
    $db->close();

    ob_start();
    require_once('includes/View/sites.php');
    $content = ob_get_contents();
    ob_end_clean();

    $title = 'Hosts Manager | Sites';
    $path = 'sites';
    $js = array('includes/View/js/sites.js');
    require_once('includes/View/template.php');
  }

  private function add() {
    $docroot = $_POST['docroot'];
    $domain = $_POST['domain'];

    $db = DbHelper::getDatabase();

    $stmt = $db->prepare("INSERT INTO sites (docroot) VALUES (?)");
    if ($stmt) {
      $stmt->bind_param('s', $docroot);
      $stmt->execute();
    }
    $site_id = $db->insert_id;

    $stmt = $db->prepare("INSERT INTO hosts (ip, hostname, locked) VALUES ('127.0.0.1', ?, 1)");
    if ($stmt) {
      $stmt->bind_param('s', $domain);
      $stmt->execute();
    }
    $host_id = $db->insert_id;

    $stmt = $db->prepare("INSERT INTO sites_to_hosts (site_id, host_id) VALUES (?,?)");
    if ($stmt) {
      $stmt->bind_param('ss', $site_id, $host_id);
      $stmt->execute();
    }

    $needs_db = FALSE;
    if (isset($_POST['needs_db']) && $_POST['needs_db'] === 'on') {
      $needs_db = TRUE;
    }

    if ($needs_db) {
      $db_name = $_POST['db_name'];
      $db_user = $_POST['db_user'];
      $db_pass = $_POST['db_pass'];

      $db->query("CREATE DATABASE $db_name");
      $db->query("GRANT ALL PRIVILEGES ON $db_name.* To '$db_user'@'localhost' IDENTIFIED BY '$db_pass'");
    }

    $db->close();

    $hosts_file_writer = new HostsFileWriter();
    $hosts_file_writer->write();

    $vhosts_file_writer = new VHostFileWriter();
    $vhosts_file_writer->write();
  }

  private function delete() {
    $id = $_POST['delete_site'];

    $db = DbHelper::getDatabase();

    $stmt = $db->prepare("DELETE FROM hosts WHERE id IN (SELECT host_id FROM sites_to_hosts WHERE site_id=?)");
    if ($stmt) {
      $stmt->bind_param('s', $id);
      $stmt->execute();
    }

    $stmt = $db->prepare("DELETE FROM sites_to_hosts WHERE site_id=?");
    if ($stmt) {
      $stmt->bind_param('s', $id);
      $stmt->execute();
    }

    $stmt = $db->prepare("DELETE FROM sites WHERE id=?");
    if ($stmt) {
      $stmt->bind_param('s', $id);
      $stmt->execute();
    }

    $db->close();

    $hosts_file_writer = new HostsFileWriter();
    $hosts_file_writer->write();

    $vhosts_file_writer = new VHostFileWriter();
    $vhosts_file_writer->write();
  }
}
