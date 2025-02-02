<?php

use App\Classes\View;

$view = new View();
$view->setTitle("Delete Data");
$view->script("/features/deleteData.js");
?>

<?php $view->startBuffering(); ?>

<main>
  <h1>
    Delete My Data
  </h1>
  <p>Are you sure you want to delete your data? This is what will happen if so:</p>
  <ul>
    <li>The site will no longer have access to your data.</li>
    <li>All of your tutorial progress will be purged from the database.</li>
    <li>You will be logged out.</li>
  </ul>
  <p>This action cannot be undone. Click the button below to confirm:</p>
  <?php
  $alertId = "delete-status";
  $alertLabel = "Deletion Status";
  require_once __DIR__ . "/../../partials/alert.php";
  ?>
  <form id="delete-data-form">
    <button
      type="submit"
      data-csrf-token="<?php echo $_SESSION["csrfToken"]; ?>">Confirm</button>
  </form>
</main>

<?php $view->stopBuffering(); ?>