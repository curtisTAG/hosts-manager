<?php

require_once('includes/RequestHandler/SetupRequestHandler.php');
require_once('includes/RequestHandler/DashboardRequestHandler.php');
require_once('includes/RequestHandler/SitesRequestHandler.php');
require_once('includes/RequestHandler/HostsRequestHandler.php');

class RequestHandlerFactory {
  public function getRequestHandler($request_type) {
    switch ($request_type) {
      case 'setup':
        return new SetupRequestHandler();
      case 'dashboard':
        return new DashboardRequestHandler();
      case 'sites':
        return new SitesRequestHandler();
      case 'hosts':
          return new HostsRequestHandler();
      default:
        throw new Exception("Invalid request type.", 1);
    }
  }
}
