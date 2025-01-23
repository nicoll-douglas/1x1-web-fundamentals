<?php
require_once __DIR__ . "/../middleware/CsrfProtection.php";
$csrf_token = CsrfProtection::initiate();
?>

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
  <form action="/api/auth/delete.php" method="POST">
    <input value="<?php echo $csrf_token; ?>" name="csrf_token" style="display: none;" />
    <button type="submit">Confirm</button>
  </form>
</main>