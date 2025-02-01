<?php

require_once __DIR__ . "/../helpers/tutorialRouteHandler.php";
require_once __DIR__ . "/../router.php";

$router->set(
  "GET",
  "/tutorials/the-web/how-the-web-works",
  tutorialRouteHandler("/tutorials/the-web/how-the-web-works.php", 1, 1)
);

$router->set(
  "GET",
  "/tutorials/the-web/domains",
  tutorialRouteHandler("/tutorials/the-web/domains.php", 1, 2)
);

$router->set(
  "GET",
  "/tutorials/the-web/common-terms-on-the-web",
  tutorialRouteHandler("/tutorials/the-web/common-terms-on-the-web.php", 1, 3)
);
