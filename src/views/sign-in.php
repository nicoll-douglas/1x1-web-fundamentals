<?php
require __DIR__ . "/../services/google_api/client.php";
?>

<main>
  <h1>Sign In</h1>
  <p>Authorize with one of the services below to sign in and save your progress.</p>
  <ul id="oauth-providers-list">
    <li>
      <a href="<?php echo $client->createAuthUrl(); ?>">
        Sign in with Google
      </a>
    </li>
  </ul>
</main>