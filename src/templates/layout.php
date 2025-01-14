<?php

require_once __DIR__ . "/../middleware/Authentication.php";
define("USER", Authentication::verify());
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/css/global.css">
  <link rel="stylesheet" href="/assets/css/layout.css">
  <title><?php echo $title; ?></title>

  <?php require_once __DIR__ . "/components/font.php"; ?>
  <?php require_once __DIR__ . "/components/csp.php"; ?>

  <?php

  if (isset($css_hrefs)):
    foreach ($css_hrefs as $css_href):
  ?>
      <link rel="stylesheet" href="<?php echo $css_href; ?>">
  <?php endforeach;
  endif; ?>

  <?php
  if (isset($script_srcs)):
    foreach ($script_srcs as $script_src):
  ?>
      <script src="<?php echo $script_src ?>" type="module"></script>
  <?php endforeach;
  endif;
  ?>


</head>

<body>
  <div id="container">

    <?php require_once __DIR__ . "/components/header.php"; ?>
    <div id="content">

      <?php require_once $view; ?>
    </div>
    <?php require_once __DIR__ . "/components/footer.php"; ?>
  </div>
</body>

</html>