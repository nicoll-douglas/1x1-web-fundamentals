<?php

use App\Classes\RequestGlobals;

$view = RequestGlobals::$view;
if (USER) {
  $view->appendData(["user" => USER]);
}
$data = $view->getData();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php if (isset($data) && isset($data["meta"])): ?>

    <?php $meta = $data["meta"]; ?>
    <title><?php echo $meta["title"]; ?></title>

    <?php if (isset($meta["css"])): ?>
      <?php foreach ($meta["css"] as $href): ?>
        <link rel="stylesheet" href="<?php echo $href; ?>">
      <?php endforeach; ?>
    <?php endif; ?>

    <?php if (isset($meta["js"])): ?>
      <?php foreach ($meta["js"] as $src): ?>
        <script src="<?php echo $src ?>" type="module" defer></script>
      <?php endforeach; ?>
    <?php endif; ?>

  <?php endif; ?>

  <link rel="stylesheet" href="/assets/css/mainLayout.css">
  <script type="module" src="/assets/js/features/mobileMenu.js" defer></script>
  <?php require_once __DIR__ . "/../partials/styles.php"; ?>
  <?php require_once __DIR__ . "/../partials/meta.php"; ?>
</head>

<body>
  <div id="container">
    <?php require_once __DIR__ . "/../partials/header.php"; ?>
    <div id="content">
      <?php $view->showContent(); ?>
    </div>
    <hr id="footer-divider">
    <?php require_once __DIR__ . "/../partials/footer.php"; ?>
  </div>
</body>

</html>