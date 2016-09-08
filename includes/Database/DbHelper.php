<?php

require_once('includes/Settings/GlobalSettings.php');

class DbHelper {
  public static function getDatabase() {
    $settings = GlobalSettings::getInstance();

    $db = new mysqli(
      $settings->get('db_host'),
      $settings->get('db_user'),
      $settings->get('db_pass'),
      $settings->get('db_name')
    );

    if ($db->connect_error) {
      throw new Exception('Unable to connect to the database.');
    }

    return $db;
  }
}
