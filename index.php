<?php

require_once('includes/Validation/InstallValidator.php');
require_once('includes/RequestHandler/RequestHandlerFactory.php');

$install_validator = new InstallValidator();
if (!$install_validator->isValid()) {
  header('Location: index.php?r=setup');
}

$request = 'dashboard';
if (isset($_GET['r'])) {
  $request = $_GET['r'];
}

$request_handler_factory = new RequestHandlerFactory();
$request_handler = $request_handler_factory->getRequestHandler($request);
$request_handler->handle();
