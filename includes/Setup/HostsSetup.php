<?php

require_once('includes/Setup/SetupInterface.php');
require_once('includes/Settings/GlobalSettings.php');
require_once('includes/Database/DbHelper.php');

class HostsSetup implements SetupInterface {

  public function setup() {
    $host_entries = $this->getHostEntries();
    $this->insertHostEntries($host_entries);
  }

  private function getHostEntries() {
    $settings = GlobalSettings::getInstance();

    $hosts_file = fopen($settings->get('path_to_hosts_file'), 'r');

    if (!$hosts_file) {
      throw new Exception('Unable to read the hosts file.');
    }

    $host_entries = array();

    while(!feof($hosts_file)) {
      $line = fgets($hosts_file);

      if ($line[0] === '#' || empty($line)) {
        continue;
      }

      $strings = preg_split('/\s+/', $line);

      if ($strings[0] === '127.0.0.1' && $strings[1] === 'localhost') {
        continue;
      }

      if ($strings[0] === '255.255.255.255' && $strings[1] === 'broadcasthost') {
        continue;
      }

      if ($strings[0] === '::1' && $strings[1] === 'localhost') {
        continue;
      }

      $host_entries[] = array(
        'ip' => $strings[0],
        'domain' => $strings[1],
      );
    }

    fclose($hosts_file);

    return $host_entries;
  }

  private function insertHostEntries($host_entries) {
    $settings = GlobalSettings::getInstance();

    $db = DbHelper::getDatabase();

    $stmt = $db->prepare("INSERT INTO hosts (ip, hostname) VALUES (?, ?)");
    if ($stmt) {
      $stmt->bind_param('ss', $ip, $hostname);

      foreach ($host_entries as $entry) {
        $ip = $entry['ip'];
        $hostname = $entry['domain'];
        $stmt->execute();
      }
    }

    $db->close();
  }
}
