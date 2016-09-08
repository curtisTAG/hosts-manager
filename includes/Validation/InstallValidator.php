<?php

require_once('includes/Settings/GlobalSettings.php');
require_once('includes/Database/DbHelper.php');

class InstallValidator {

  public function isValid() {
    try {
      $db = DbHelper::getDatabase();
      $db->close();
    } catch (Exception $e) {
      return FALSE;
    }

    $settings = GlobalSettings::getInstance();

    $file = fopen($settings->get('path_to_hosts_file'), 'w');
    if (!$file) {
      return FALSE;
    }
    fclose($file);

    $file = fopen($settings->get('path_to_vhosts_file'), 'w');
    if (!$file) {
      return FALSE;
    }
    fclose($file);

    return TRUE;
  }
}
