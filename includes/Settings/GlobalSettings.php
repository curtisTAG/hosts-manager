<?php

class GlobalSettings {

  private $settings_array;

  private static $instance;

  public static function getInstance() {
    if (static::$instance === NULL) {
      static::$instance = new static();
    }
    return static::$instance;
  }

  private function __construct() {
    $this->settings_array = require_once('settings.php');
  }

  public function get($key) {
    if (isset($this->settings_array[$key])) {
      return $this->settings_array[$key];
    }
    return NULL;
  }

  private function __clone() {}
  private function __wakeup() {}
}
