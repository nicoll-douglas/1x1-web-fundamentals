<?php

use App\Classes\RequestGlobals;

$view = RequestGlobals::$view;
$data = $view->getData();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php if (isset($data) && isset($data["meta"])): ?>
    <?php $meta = $data["meta"]; ?>
    <title><?php echo $meta["title"]; ?></title>
  <?php endif; ?>

  <link rel="stylesheet" href="/assets/css/basicLayout.css">
  <?php require_once __DIR__ . "/../partials/styles.php"; ?>
  <?php require_once __DIR__ . "/../partials/meta.php"; ?>
</head>

<body>
  <?php $view->showContent(); ?>
</body>

</html>