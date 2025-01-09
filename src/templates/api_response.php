<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?></title>
  <?php require_once __DIR__ . "/components/font.php" ?>
  <link rel="stylesheet" href="/assets/css/global.css">
  <link rel="stylesheet" href="/assets/css/api.css">
</head>

<body>
  <p class="<?php echo $error ? "message-error" : "message-success"; ?>">
    <?php echo $view; ?>
  </p>
  <a href="/">Back to home</a>
</body>

</html>