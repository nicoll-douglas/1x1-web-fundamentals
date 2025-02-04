<?php

if (getenv("APP_ENV") === "development") {
  $scriptSrc = "* 'unsafe-inline' 'unsafe-eval'";
} else {
  $scriptSrc = "'self' 'nonce-" . NONCE . "'";
}

?>

<meta
  http-equiv="Content-Security-Policy"
  content="
  default-src 'self';
  script-src <?php echo $scriptSrc; ?>;
  style-src 'self' 'unsafe-inline' https://fonts.googleapis.com;
  font-src 'self' https://fonts.gstatic.com;
  img-src 'self';
  connect-src 'self';
  frame-src 'none';
  object-src 'none';
  " />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">