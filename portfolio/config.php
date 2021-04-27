<?php
$config = array(
  "db" => array(
    "server" => "localhost",
    "user" => "root",
    "pass" => "123",
    "db" => "portfolio_new"
  ),
  "pages" => array(
    "index" => "Skraagen → Portfolio",
    "login" => "Skraagen → Login"
  )
);

defined("LIBRARY_PATH")
  or define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/resources/libs'));

defined("TEMPLATES_PATH")
  or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . '/includes/templates'));

defined("VIEWS_PATH")
  or define("VIEWS_PATH", realpath(dirname(__FILE__) . '/includes/views'));

switch (basename($_SERVER['PHP_SELF'])) {
  case "login.php":
    $PAGE_TITLE = $config["pages"]["index"];
    break;
  default:
    $PAGE_TITLE = $config["pages"]["login"];
}
?>
