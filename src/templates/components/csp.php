<?php
require_once __DIR__ . "/../../config/env.php";

define("NONCE", bin2hex(random_bytes(16)));
?>
<meta
  http-equiv="Content-Security-Policy"
  content="
  default-src 'self';
  script-src <?php
              if (getenv("APP_ENV") === "development") {
                echo "* 'unsafe-inline' 'unsafe-eval'";
              } else {
                echo "'self' 'nonce-" . NONCE . "'";
              }
              ?>;
  style-src 'self' https://fonts.googleapis.com;
  font-src 'self' https://fonts.gstatic.com;
  img-src 'self' https:;
  connect-src 'self';
  frame-src 'none';
  object-src 'none';
  " />