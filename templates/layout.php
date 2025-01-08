<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/global.css">
  <title><?php echo $title; ?></title>
  <?php if (!empty($custom_css_href)): ?>
    <link rel="stylesheet" href="<?php echo $custom_css_href; ?>">
  <?php endif; ?>
</head>

<body>
  <div id="container">
    <?php require_once __DIR__ . "/components/header.php"; ?>
    <div id="content">
      <?php require_once $content_file; ?>
    </div>
    <?php require_once __DIR__ . "/components/footer.php"; ?>
  </div>
</body>

</html>