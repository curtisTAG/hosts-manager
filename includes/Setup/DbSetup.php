<?php

require_once('includes/Setup/SetupInterface.php');
require_once('includes/Database/DbHelper.php');

class DbSetup implements SetupInterface {

  public function setup() {
    $db = DbHelper::getDatabase();

    $db->query('DROP DATABASE IF EXISTS hosts_manager');

    $db->query('CREATE DATABASE hosts_manager');

    $db->query('USE hosts_manager');

    $db->query('
      CREATE TABLE hosts (
        id int NOT NULL AUTO_INCREMENT,
        ip varchar(15) NOT NULL,
        hostname varchar(255) NOT NULL,
        status boolean not null default 1,
        locked boolean not null default 0,
        PRIMARY KEY (id)
      )
    ');

    $db->query('
      CREATE TABLE sites (
        id int NOT NULL AUTO_INCREMENT,
        docroot varchar(255) NOT NULL,
        PRIMARY KEY (id)
      )
    ');

    $db->query('
      CREATE TABLE sites_to_hosts (
        id int NOT NULL AUTO_INCREMENT,
        host_id int NOT NULL,
        site_id int NOT NULL,
        PRIMARY KEY (id),
        CONSTRAINT fk_host_id FOREIGN KEY (host_id) REFERENCES hosts(id) ON DELETE NO ACTION,
        CONSTRAINT fk_site_id FOREIGN KEY (site_id) REFERENCES sites(id) ON DELETE NO ACTION
      )
    ');

    $db->close();
  }
}
